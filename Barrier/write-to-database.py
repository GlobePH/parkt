#!C:\Python27\python.exe
# Server side code to read data sent by pi through GET method.

import cgi, cgitb
import os
import time
import datetime
import MySQLdb
from time import strftime
import urllib

# Create instance of FieldStorage 
form = cgi.FieldStorage() 
# Get data from client
alert = form.getvalue('alert') 

print "Content-type:text/html\r\n\r\n"
print ""
print ""
print "Data Storage"
print ""
print "" 

# Alert user if recorded temperature is above a threshold (30 degrees in this case)
if alert: 
  push = '1'
  message = 'Alert! ' + str(alert) + 'has been moved!'
  url="http://barrier.herokuapp.com/sending-push-notifications.php?push="+push+"&message="+message 
  response = urllib.urlopen(url) #sends url request to another file responsible for sending GCM alerts
  data = response.read()
  print data
  
#Code to write the recorded temperature in the MYSQL database 'templog' and table 'temp-at-interrupt'
db = MySQLdb.connect(host="localhost", user="barrieradmin", passwd="password", db="barrierdb")
cur = db.cursor()

while True:
  sql = ("""UPDATE `barrier_data` SET `barrier_status`=0 WHERE `barrier_id`=%s;""", alert)
  try:
    cur.execute(*sql)
    db.commit()
    print "\nProcess finished"
  except:
    db.rollback()
    print "\nProcess Failed to Complete"

  cur.close()
  db.close()
  break