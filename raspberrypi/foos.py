# -*- coding: utf-8 -*-
"""
Created on Mon Oct 27 21:03:47 2014

@author: Lucien
"""

import datetime
import serial
import smtplib
import os
import subprocess
import urllib
import random
import time
import urllib2
serialport = 3


##which serial port the arduino is connected to; usually COM 3. sometimes doesn't work
##and you have to restart comp.



goals = []


temp1 = '0'
temp2 = '0'
i = 0
k = 0

tableid = '1'
threshold1 = '0'
threshold2 = '0'


query_args = {'table':tableid}


##Starting a connection to the serial input.

ser = serial.Serial('/dev/ttyACM0', 9600)

##Loop indefinetely
while True:
        if (i == 0):
            message = ser.readline()
            ##getting the value found from the serial port of the value detected
            ##from output 0 of arduino
        
            current_time = datetime.datetime.now()
            ##getting current time from computer
        
            goals = message.split()
            print goals
		##goals = ['0','0']
            ##making the voltage into a value we can analyse in program

            ##Making sure that the serial input is properly formatted.
	    ##If it isn't, maintain the goal state as it was in the previous
	    ##tick.
	    
            
	    try: 
		    if(len(goals) == 2 and (int(goals[0])<2000 and  int(goals[0]) >0) and( int(goals[1]) <2000 and  int(goals[1]) >0)):
		    	
	    		threshold1 = '0'
	   		threshold2 = '0'
	   		##If 
            		if(int(goals[0]) > 970):
						threshold1 = '1'
	    	   
            		if(int(goals[1]) > 520):
						threshold2 = '1'

            except ValueError:
		threshold1 = temp1
		threshold2 = temp2
	    

	   
        ##This program only calculates if a goal has been scored and on what side 
            if threshold1  == '0' and temp1 == '1':
                #print message_list[0]
                print 'goal one scored on'
                temp1 = '0'
                
		#query_args = {'player':'1','game':GAMEID}
		query_args = {'tableId':tableid,'player':'1'}
		url1 = 'http://foosrpi.com/goal/'
		data = urllib.urlencode(query_args)
		request = urllib2.Request(url1,data)
		print urllib2.urlopen(request).read()
            	time.sleep(4)
	    else:
                temp1 = '1'
                
            
            if threshold2  == '0' and temp2 == '1':
                print 'goal two scored on'
                #print message_list[1]
                temp2 = '0'
		               
                #query_args = {'player':'2','game':GAMEID}
                query_args = {'tableId':tableid,'player':'2'}
                url1 = 'http://foosrpi.com/goal/'
                data = urllib.urlencode(query_args)
                request = urllib2.Request(url1,data)
                print urllib2.urlopen(request).read()
		time.sleep(4)
            else:
                temp2 = '1'
            temp1 = threshold1
            temp2 = threshold2
        else:
            
            message = ser.readline()
            
	    print i

