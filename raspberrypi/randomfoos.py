# -*- coding: utf-8 -*-
"""
Created on Mon Oct 27 21:03:47 2014

@author: Lucien
"""

import datetime
##import serial
import smtplib
import os
import subprocess
import urllib
import random
import time
serialport = 3


##which serial port the arduino is connected to; usually COM 3. sometimes doesn't work
##and you have to restart comp.


##message is just so we dont have unidentified var

goals = []
##safety == False if you want computer to turn off
##safety == True if you want computer to stay on
safety = False

##Loop indefinetely
temp1 = '0'
temp2 = '0'
i = 0
p1 = 0
p2 = 0
k = 0
RIN1 = '661374900'
RIN2 = '665554444'


url1 = urllib.urlopen('http://foosrpi.com/start?rin1='+RIN1+'&rin2='+RIN2)
GAMEID = url1.read()

##ser = serial.Serial('COM3', 9600)
while True:
    if p1 == 10 or p2 == 10:
        p1 = 0
        p2 = 0
        temp1 = '0'
        temp2 = '0'
        ##urllib.urlopen('http://foosrpi.edu/end?game='+GAMEID)
       
        k+=1
        url1 = urllib.urlopen('http://foosrpi.com/start?rin1='+RIN1+'&rin2='+RIN2)
        GAMEID = url1.read()
    else:
        if (i == 0):
            ##message = ser.readline()
            ##getting the value found from the serial port of the value detected
            ##from output 0 of arduino
        
            current_time = datetime.datetime.now()
            ##getting current time from computer
        
            ##goals = message.split()
            goals = ['0','0']
            ##making the voltage into a value we can analyse in program
            print goals[0],goals[1],GAMEID,p1,p2
            ##Temp random seed
            random.seed();
            time.sleep(.1)
            random2 = random.randint(0,10)
            print random2
            if random2 == 10:
                if random.randint(0,1) == 1:
                    goals[0] = '1'
                    goals[1] = '0'
                else:
                    goals[0] = '0'
                    goals[1] = '1'
                    
            print goals[0],goals[1],GAMEID,p1,p2
            if goals[0] == '0' and temp1 == '1':
                #print message_list[0]
                print 'goal one scored on'
                temp1 = '0'
                i+=40
                p1+=1
                print 'http://foosrpi.com/goal?player=1&game='+GAMEID
                print urllib.urlopen('http://foosrpi.com/goal?player=1&game='+GAMEID).read()
            else:
                temp1 = '1'
                
            
            if goals[1] == '0' and temp2 == '1':
                print 'goal two scored on'
                #print message_list[1]
                temp2 = '0'
                i+=40
                p2+=1
                print 'http://foosrpi.com/goal?player=2&game='+GAMEID                
                urllib.urlopen('http://foosrpi.com/goal?player=2&game='+GAMEID).read()
            else:
                temp2 = '1'
            temp1 = goals[0]
            temp2 = goals[1]
        else:
            ##time.sleep(4)
            ##message = ser.readline()
            i-=1

