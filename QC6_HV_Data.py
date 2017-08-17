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
#import cx_Oracle
#import json
def xml_from_excel4(excel_file):
	wb = xlrd.open_workbook(excel_file)
	sh = wb.sheet_by_index(0)
	req = sh.cell(1,16).value
	pre = sh.cell(5,16).value
	amp = sh.cell(8,16).value
	coa = sh.cell(9,16).value
	fine = sh.cell(10,16).value
	itime = sh.cell(12,16).value
	dtime = sh.cell(13,16).value
	disc = sh.cell(16,16).value
	thrs = sh.cell(17,16).value
	scal = sh.cell(20,16).value
	daq = sh.cell(21,16).value
	Start=sys.argv[7]
	Stop=sys.argv[8]
	chamber=sys.argv[2]
	Date=str(Start[0:10])
	location=sys.argv[4]
	#user=sh.cell(1,7).value
	user=sys.argv[5]
	comment=sys.argv[6]
	Comment=sys.argv[11]
	Run=sys.argv[3]
	root = generateXMLHeader("QC6_HVTEST_CONFIG","GEM Chamber QC6 HVTEST Config",str(location) + " GEM QC6 HV Test Config",Run,Start,Stop,comment,location,user)
	dataSet = generateDataSet(root,Comment,"1","GEM Chamber",chamber)
	generateXMLData4a(dataSet,str(req), str(pre),str(amp),str(coa), str(fine), str(itime),str(dtime),str(disc),str(thrs),str(scal),str(daq))
	writeToFile(fileName, tostring(root))
	root = generateXMLHeader("QC6_HVTEST_DATA","GEM Chamber QC6 HVTEST Data",str(location) + " GEM QC6 HV Test Data",Run,Start,Stop,comment,location,user)
	dataSet = generateDataSet(root,Comment,"1","GEM Chamber",chamber)
	for row in range(3, sh.nrows):
		if sh.row_values(row)[0]=='':
			break
		vset = sh.row_values(row)[0]
		vmon= sh.row_values(row)[1]
		iset =sh.row_values(row)[2]
		imon= sh.row_values(row)[3]
		rcal =sh.row_values(row)[4]
		rnorm=sh.row_values(row)[5]
		count=sh.row_values(row)[6]
		rate= sh.row_values(row)[7]
		error=sh.row_values(row)[8]
		generateXMLData4(dataSet,str(vset), str(vmon),str(iset),str(imon), str(rcal), str(rnorm),str(count),str(rate),str(error))
		writeToFile(datafile, tostring(root))
		
	v_max = sh.cell(25,16).value
	test_date=Start
	v_drift = sh.cell(26,16).value
	i_max = sh.cell(27,16).value
	r_euq = sh.cell(28,16).value
	r_err= sh.cell(29,16).value
	r_diff = sh.cell(30,16).value
	spr_signal = sh.cell(31,16).value
	spr_error = sh.cell(32,16).value
	Filename= sys.argv[10]
	Elog=sys.argv[9]
	#Comment=sys.argv[11]
	root = generateXMLHeader("QC6_HVTEST_SUMRY","GEM Chamber QC6 HVTEST Summary",str(location) + " GEM QC6 HV Test Summary",Run,Start,Stop,comment,location,user)
	dataSet = generateDataSet(root,Comment,"1","GEM Chamber",chamber)
	generateXMLData4s(dataSet,test_date,str(v_max),str(i_max),str(v_drift),str(r_euq), str(r_err), str(r_diff),str(spr_signal),str(Filename),str(Elog),str(Comment))
	writeToFile(testfile, tostring(root))

#_result = {}
#_result['XLS_FILE'] = fileName
#_result['var'] = testfile

#print json.dumps(_result)

if __name__ =="__main__":	
	#fname=raw_input("Enter excel data file name:")
	fname = sys.argv[1]
	fileName=fname+".xml"
	datafile=fname+"_Data.xml"
	testfile=fname+"_summry.xml"
	xml_from_excel4(fname)
	print 1
	print 2
