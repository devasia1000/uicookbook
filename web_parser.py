__author__ = 'Howard and Ray'

"""
This is a web_parser script to be run in order to pull recipes from common
websites and insert them into a database. These recipes will be used as part of
an Assignment for CS411@UIUC for learning purposes only.
"""

from bs4 import BeautifulSoup
import re
import urllib
from database_interaction import DatabaseInteraction

# A list of urls to be used to pull recipes from.
urls = ["http://www.allrecipes.com"]
db = DatabaseInteraction()

for url in urls:
    print '---- Crawling ' + url + ' ----\n'
    html_text = urllib.urlopen(url).read()
    soup = BeautifulSoup(html_text)

    for container in soup.findAll("ul", id="recsRecipeContainer"):
        recipe_anchor = container.find("a")
        recipe_ref = recipe_anchor["href"]
        recipe_url = url + recipe_ref

        recipe_html_text = urllib.urlopen(recipe_url).read()

        # Replace <br/> with new lines
        recipe_html_text = re.sub('<br\s*?>', '\n', recipe_html_text)

        recipe_soup = BeautifulSoup(recipe_html_text)

        recipe_name = recipe_soup.find("p", "recipeTitle").get_text()
        directions = ""
        amounts = []
        ingredients = []

        print '---- Analyzing Recipe: ' + recipe_name + ' ----\n'

        # Ensure recipe is not already in database.
        if db.is_recipe_in_db(recipe_name) is False:
            ingredients_counter = 0
            for dir_tag in recipe_soup.findAll('span', "plaincharacterwrap break"):
                directions += dir_tag.get_text()

            for ingredients_tag in recipe_soup.findAll('p', "fl-ing"):
                findAmt = ingredients_tag.find(id="lblIngAmount")
                findOptional = ingredients_tag.find(id="lblOptional")

                if findAmt is not None and findOptional is None:

                    tag3 = ingredients_tag.find(id="lblIngName")
                    tag4 = ingredients_tag.find(id="lblIngAmount")
                    currentIngredient = tag3.get_text()
                    currentAmount = tag4.get_text()
                    if currentIngredient not in ingredients:
                        currentAmount = re.sub(r'[^\x00-\x7F]+', '', currentAmount)
                        currentIngredient = re.sub(r'[^\x00-\x7F]+', '', currentIngredient)

                        amounts.append(currentAmount.decode('ascii'))
                        ingredients.append(currentIngredient.decode('ascii'))
                        ingredients_counter += 1
                    else:
                        currentIngredient = re.sub(r'[^\x00-\x7F]+', '', currentIngredient)
                        currentIngredientNumber = re.findall('\d+', currentIngredient)
                        currentIngredientUnit = re.sub('\d+', '',currentIngredient)
                        recipeData = []
                        recipeData.append(recipe_name)
                        recipeData.append("")
                        sql = """SELECT recipeid FROM recipes2 WHERE recipeName = %s userEmail = %s"""
                        db.cursor.execute(sql, recipeData)
                        recipeID = db.cursor.fetchone()
                        db.update_ingredient_in_database(recipeID, currentIngredientNumber, currentIngredientUnit, currentIngredient)



            db.insert_recipe_into_database(recipe_name, directions, ingredients_counter, ingredients, amounts)
            print ingredients
            print amounts
            print ""
            print directions + "\n"




