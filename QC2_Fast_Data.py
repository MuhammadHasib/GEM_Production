#!/usr/bin/env python
from datetime import datetime,date,time
from time import sleep
from xml.etree.ElementTree import Element, SubElement, Comment, tostring
#import serial
import time
import xlrd
from xlrd import xldate
import re
import sys
#import statistics
from xmlConversion import generateXMLHeader, generateDataSet, writeToFile,writeToFile1
from xmlConversion import generateXMLDatafastamb,generateXMLDatafast,generateXMLDatalongamb,generateXMLDatalong, generateXMLData3,generateXMLData3a,generateXMLData4,generateXMLData4a,generateXMLData5a,generateXMLData5,generateXMLData4s
#from flask import Flask, render_template
#from flask_sqlalchemy import SQLAlchemy
#from sqlalchemy import create_engine, MetaData, Table, and_
#from sqlalchemy.sql import select
#import cx_Oracle



#QC2
def xml_from_excel2(excel_file):
	wb = xlrd.open_workbook(excel_file)
	sh = wb.sheet_by_index(0)
	tags = [n.replace(" ", "").lower() for n in sh.row_values(0)]
	Start=sys.argv[6]
	Stop=sys.argv[7]
	#foil=sh.cell(0,1).value
	foil=sys.argv[9]
	Date=sh.cell(1,1).value
	#location=sh.cell(3,1).value
	location=sys.argv[3]
	#comment=raw_input("Make a Comment:")
	comment=sys.argv[5]
	Comment=sys.argv[8]
	#user=sh.cell(6,1).value
	user=sys.argv[4]
	Run=sys.argv[2]
	humidity = sh.cell(2,1).value
	root = generateXMLHeader("FOIL_QC2_FAST_AMB_COND","GEM Foil QC2 Fast Test Condition","CERN MPT GEM Foil QC2 Fast Test Data",Run,Start,Stop,comment,location,user)
	dataSet = generateDataSet(root,Comment,"1","GEM Foil",foil)
	generateXMLDatafastamb(dataSet,humidity)
	writeToFile1(testfile, tostring(root))
	root = generateXMLHeader("FOIL_QC2_FAST_TEST","GEM Foil QC2 Fast Test Data","GEM Foil QC2 Fast Test Data",Run,Start,Stop,comment,location,user)
	dataSet = generateDataSet(root,Comment,"1","GEM Foil",foil)
	for row in range(12,sh.nrows):
		time=sh.row_values(row)[0]
		volt=sh.row_values(row)[1]
		impedence=sh.row_values(row)[2]
		current=sh.row_values(row)[3]
		sparks=sh.row_values(row)[4]
		totalspark=sh.row_values(row)[5]
		generateXMLDatafast(dataSet,str(time),str(volt),str(impedence),str(current),str(sparks),str(totalspark))
		writeToFile(fileName,tostring(root))


if __name__ =="__main__":	
	#fname=raw_input("Enter excel data file name:")
	fname = sys.argv[1]
	#fileName=fname+"_fast"+".xml"
	fileName=fname+".xml"
	testfile=fname+"_amb"+".xml"
	xml_from_excel2(fname)
