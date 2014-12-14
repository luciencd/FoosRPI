/*
  SD card datalogger
 
 This example shows how to log data from three analog sensors 
 to an SD card using the SD library.
 	
 The circuit:
 * analog sensors on analog ins 0, 1, and 2
 * SD card attached to SPI bus as follows:
 ** MOSI - pin 11
 ** MISO - pin 12
 ** CLK - pin 13
 ** CS - pin 4
 
 created  24 Nov 2010
 modified 9 Apr 2012
 by Tom Igoe
 
 This example code is in the public domain.
 	 
 */

#include <SD.h>

// On the Ethernet Shield, CS is pin 4. Note that even if it's not
// used as the CS pin, the hardware CS pin (10 on most Arduino boards,
// 53 on the Mega) must be left as an output or the SD library
// functions will not work.
const int chipSelect = 10;
int led = 3;

//pinMode(0, OUTPUT);
void setup()
{
 // Open serial communications and wait for port to open:
  Serial.begin(9600);
   while (!Serial) {
    ; // wait for serial port to connect. Needed for Leonardo only
  }
  pinMode(4, INPUT);
  pinMode(3, INPUT);
}

void loop()
{
  // make a string for assembling the data to log:
  
  String dataString = "";
  int dataInt = 0;
  
  // read three sensors and append to the string:

    //player1 = analogRead(4);
    //int player2 = analogRead(3);
    //dataString += String(player1);
    //dataString += " ";
    //dataString += String(player2);
    if (analogRead(3) > 85){ //45 in dark, 55 in light
      dataString += "1 ";
    } else {
      dataString += "0 ";
    }    
    if (analogRead(4) > 530){ //45 in dark, 55 in light
      dataString += "1 ";
    } else {
      dataString += "0 ";
    }
    
  // open the file. note that only one file can be open at a time,
  // so you have to close this one before opening another.
  
    Serial.print(dataString);
    Serial.print(analogRead(3));
    Serial.print(" ");
    Serial.println(analogRead(4));
  // if the file isn't open, pop up an error:
 
  delay(100);
}








