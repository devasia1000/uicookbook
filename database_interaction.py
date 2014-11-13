__author__ = 'Ray and Howard'

import MySQLdb
import sys
import re



class DatabaseInteraction(object):

    def __init__(self):
        # Establish Connection to the desired MySQL Database.
        self.db = MySQLdb.connect(host="engr-cpanel-mysql.engr.illinois.edu",
                             user="uicookbo_howard", passwd="helloworld",
                             db="uicookbo_main")
        if not self.db.open:
            print "Could not connect to database. Exiting Script..."
            sys.exit()

        print '---- Connected to Database ----\n'

        self.cursor = self.db.cursor()

    def __del__(self):
        self.db.close()


    def insert_recipe_into_database(self, recipe_name, directions, ingredientsCounter, ingredients, amount):
        sql ="""
                 INSERT INTO recipes2(recipeName, steps, userEmail)
                 VALUES(%s, %s, %s)"""
        recipeData = []
        email = ""
        recipeData.append(recipe_name)
        recipeData.append(directions)
        recipeData.append(email)  #change later

        self.cursor.execute(sql, recipeData)
        self.db.commit()
        sql2 = """SELECT recipeid FROM recipes2 WHERE recipeName = %s AND steps = %s AND userEmail = %s"""
        self.cursor.execute(sql2, recipeData)
        recipeID = self.cursor.fetchone()
        thisRecipeID = int(recipeID[0])
        print ingredients

        for x in range(0, ingredientsCounter):
            sql = """INSERT INTO ingredients(recipeID, ingredientName, amount)
                    VALUES(%s, %s, %s)"""
            indexIngr = ingredients[x]
            indexAmt = amount[x]
            ingredientData = []
            ##print thisRecipeID
            ingredientData.append(thisRecipeID)
            ingredientData.append(indexIngr)
            ingredientData.append(indexAmt)
            self.cursor.execute(sql, ingredientData)
            self.db.commit()

        return


    def is_recipe_in_db(self, check_recipe_name):
        query = "SELECT * FROM recipes2 WHERE recipeName = %s"
        self.cursor.execute(query, [check_recipe_name])
        if self.cursor.fetchone() is None:
            return False

        else :
            return True

    def update_ingredient_in_database(self, recipeID, currentIngredientNumber, currentIngredientUnit, currentIngredient):
        sql = """SELECT amount FROM ingredients WHERE recipeID = %s AND ingredientName = %s"""
        ingredientData = []
        ingredientData.append(recipeID)
        ingredientData.append(currentIngredient)
        self.cursor.execute(sql, ingredientData) #get the amount from the selected data
        databaseAmount = self.cursor.fetchone()
        databaseNumber = re.findall('\d+', databaseAmount) #take the numbers out
        databaseNumber += currentIngredientNumber #add the number together
        updatedInformation = databaseNumber + ' ' + currentIngredientUnit #make a new string without unit conversion
        sql = """SELECT * FROM ingredients WHERE recipeID = %s AND ingredientName = %s"""
        self.cursor.execute(sql, ingredientData)
        databaseIngredient = self.cursor.fetchone() #get an array of all the information
        sql = """DELETE FROM ingredients(recipeID, ingredientName, amount) VALUES(%s, %s, %s)""" #delete the original from the database
        self.cursor.execute(sql, databaseIngredient)
        databaseIngredient.pop([2])
        databaseIngredient.append(updatedInformation) #delete and add the new data
        sql = """INSERT INTO ingredients(recipeID, ingredientName, amount)
                    VALUES(%s, %s, %s)"""
        self.cursor.execute(sql, databaseIngredient) #add the new data into the database
        return

