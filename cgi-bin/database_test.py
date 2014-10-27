import mysql.connector

cnx = mysql.connector.connect(user='', password='', host='127.0.0.1', database='uicookbo_main')

query = ("SELECT * FROM recipes")

cursor.execute(query)

for x in cursor:
    print x

cursor.close()

cnx.close()
