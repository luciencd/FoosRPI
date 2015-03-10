#!/usr/bin/python

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


ipaddr = os.system('ip addr show eth0 | grep inet > ip.txt')

file = open('ip.txt','r')

ip = file.read()
ip = ip.split(' ')
print ip
ip[5] = ip[5].split('/')
print ip
urllib.urlopen('http://foosrpi.com/recordIP/index.php?ip='+ip[5][0])
quit(ipaddr)
