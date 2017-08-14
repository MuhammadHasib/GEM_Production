#!/usr/bin/env python
from datetime import datetime,date,time
from time import sleep
from xml.etree.ElementTree import Element, SubElement, Comment, tostring
import serial
import time
import xlrd
from xlrd import xldate
import re
import sys
import statistics
from xmlConversion import generateXMLHeader, generateDataSet, writeToFile,writeToFile1
from xmlConversion import generateXMLDatafastamb,generateXMLDatafast,generateXMLDatalongamb,generateXMLDatalong, generateXMLData3,generateXMLData3a,generateXMLData4,generateXMLData4a,generateXMLData5a,generateXMLData5,generateXMLData4s
from flask import Flask, render_template
from flask_sqlalchemy import SQLAlchemy
from sqlalchemy import create_engine, MetaData, Table, and_
from sqlalchemy.sql import select
import cx_Oracle

def xml_from_excel3(excel_file):
	wb = xlrd.open_workbook(excel_file)
	sh = wb.sheet_by_index(0)
	Start=str(ObtainDate("Test Start Time(with Date like 2017-01-16):","%Y-%m-%d %H:%M:%S"))
	Stop=str(ObtainDate("Test End Time:","%Y-%m-%d %H:%M:%S"))
	chamber=sh.cell(2,7).value
	Date=str(Start[0:10])
	location=raw_input("Enter Location:")
	user=sh.cell(1,7).value
	comment=raw_input("Make a Comment:")
	root = generateXMLHeader("QC3_GAS_LEAK_DATA","GEM Chamber QC3 Gas Leak Data","CERN Station A GEM Chamber QC3 Gas Leak Data",Run,Start,Stop,comment,location,user)	
	dataSet = generateDataSet(root,"GEM Chamber QC3 Gas Leak Calib Data","1","GEM Chamber",chamber)	
	for row in range(1,sh.nrows):
			seconds= sh.row_values(row)[1]
			pre= sh.row_values(row)[2]
			temp =sh.row_values(row)[3]
			ambp= sh.row_values(row)[4]
			times = xlrd.xldate_as_tuple(sh.row_values(row)[0], wb.datemode)
			times=str(times).replace(",",":")
			times = str(times).replace(")","")
			times = str(times).replace("("," ")
			generateXMLData3(dataSet,Date +str(times)[9:],str(seconds),str(pre), str(ambp), str(temp))
			writeToFile(fileName, tostring(root))
	test_date=sh.cell(0,7).value
	avgtemp=sh.cell(32,7).value
	stdtemp=sh.cell(32,8).value
	avgpre=sh.cell(33,7).value
	stdpre=sh.cell(33,8).value
	initpre = sh.cell(34,7).value
	finalpre = sh.cell(35,7).value
	duration = sh.cell(36,7).value
	leakrate = sh.cell(37,7).value
	expofitp0=sh.cell(38,7).value 
	expofitp1=sh.cell(39,7).value 
	expofitR2=sh.cell(40,7).value
	elog=raw_input("Please Enter the ELOG LINK:")
	File=raw_input("Please Enter the File Name:")
	Comments=raw_input("Make a summary Comment:")
	root = generateXMLHeader("QC3_GAS_LEAK_DATA_SUMMARY","GEM Chamber QC3 Gas Leak Data Summary ","CERN Station A GEM Chamber QC3 Gas Leak Data Summary",Run,Start,Stop,comment, location,user)
	dataSet = generateDataSet(root,"GEM Chamber QC3 Gas Leak Data Summary","1","GEM Chamber",chamber)
	generateXMLData3a(dataSet, str(test_date) ,str(avgtemp),str(stdtemp),str(avgpre),str(stdpre),str(initpre),str(finalpre),str(duration),str(leakrate),str(expofitp0),str(expofitp1),str(expofitR2),str(elog),str(File),str(Comments))
	writeToFile1(datafile, tostring(root))

	if select==3:
		root = generateXMLHeader("QC3_GAS_FULL_SUMMARY","GEM Chamber QC3 Gas Full Summary","CERN Station A GEM Chamber QC3 Gas Full Summary",Run,Start,Stop,comment,location,user)
		dataSet = generateDataSet(root,"GEM Chamber QC3 Gas Full Summary","1","GEM Chamber",chamber)

if __name__ =="__main__":	
	#fname=raw_input("Enter excel data file name:")
	fname = sys.argv[1]
	fileName=fname+".xml"
	datafile=fname+"_Data.xml"
	testfile=fname+"_summry.xml"
	xml_from_excel3(fname)	
