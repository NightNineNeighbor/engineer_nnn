/*
 Pi_Serial_test.cpp - SerialProtocol library - demo
 Copyright (c) 2014 NicoHood.  All right reserved.
 Program to test serial communication
 
 Compile with:
 sudo gcc -o Pi_Serial_Test.o Pi_Serial_Test.cpp -lwiringPi -DRaspberryPi -pedantic -Wall
 sudo ./Pi_Serial_Test.o
 */
//sudo gcc -o test SendGcode.c -lwiringPi -DRaspberryPi 
// just that the Arduino IDE doesnt compile these files.
#ifdef RaspberryPi 
 
//include system librarys
#include <stdio.h> //for printf
#include <stdint.h> //uint8_t definitions
#include <stdlib.h> //for exit(int);
#include <string.h> //for errno
#include <errno.h> //error output
 
//wiring Pi
#include <wiringPi.h>
#include <wiringSerial.h>

#include <unistd.h>
#include <sys/stat.h>
#include <fcntl.h>
 
// Find Serial device on Raspberry with ~ls /dev/tty*
// ARDUINO_UNO "/dev/ttyACM0"
// FTDI_PROGRAMMER "/dev/ttyUSB0"
// HARDWARE_UART "/dev/ttyAMA0"
char device[]= "/dev/ttyUSB0";
// filedescriptor
int fd, in;
int end=1;
char filename[100];
unsigned long baud = 115200;
unsigned long time=0;
 
//prototypes
int main(void);
void loop(void);
void setup(void);
 
void setup(){
 
  printf("%s \n", "Raspberry Startup!");
  fflush(stdout);
 
  //get filedescriptor
  if ((fd = serialOpen (device, baud)) < 0){
    fprintf (stderr, "Unable to open serial device: %s\n", strerror (errno)) ;
    exit(1); //error
  }


  scanf("%s",filename);
  printf("before open\n"); 
  in = open(filename,O_RDONLY);
  if(in==-1){
    printf("faile Open, can't find %s file\n",filename);
    exit(1);
  }
  printf("after open\n");

  //setup GPIO in wiringPi mode
  if (wiringPiSetup () == -1){
    fprintf (stdout, "Unable to start wiringPi: %s\n", strerror (errno)) ;
    exit(1); //error
  }
  
  sleep(3);

  char c;
  int i=0;
  char *command="M28 Sample5.g\n";
  while(command[i]!=NULL){
    serialPutchar(fd,command[i++]);
    //serialPutchar(fd,'\n');
    if(serialDataAvail(fd)){
      char newChar=serialGetchar(fd);
      printf("%c",newChar);
      fflush(stdout);
    }
  }
}
 
void loop(){
  char c;
  int a;
  //write gcode to Serial port
  if(read(in,&c,1)==1){
    serialPutchar(fd,c);
    //serialPutchar(fd,'\n');
  }
  else end=0;

  // read signal
  if(serialDataAvail (fd)){
    char newChar = serialGetchar (fd);
    printf("%c", newChar);
    fflush(stdout);
  }
}

// main function for normal c++ programs on Raspberry
int main(){
  setup();
  while(end) loop();
  char *command="M29\n";
  int i=0;
  while(command[i]!=NULL){
    serialPutchar(fd,command[i++]);
    //serialPutchar(fd,'\n');
    if(serialDataAvail(fd)){
      char newChar=serialGetchar(fd);
      printf("%c",newChar);
      fflush(stdout);
    }
  }
  sleep(2);
  return 0;
}

#endif //#ifdef RaspberryPi
