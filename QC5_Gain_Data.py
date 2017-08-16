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
from xmlConversion import generateXMLDatafastamb,generateXMLDatafast,generateXMLDatalongamb,generateXMLDatalong, generateXMLData3,generateXMLData3a,generateXMLData4,generateXMLData4a,generateXMLData5a,generateXMLData5,generateXMLData4s, generateXMLData5s
#from flask import Flask, render_template
#from flask_sqlalchemy import SQLAlchemy
#from sqlalchemy import create_engine, MetaData, Table, and_
#from sqlalchemy.sql import select


#QC5
def xml_from_excel5(excel_file):
	wb = xlrd.open_workbook(excel_file)
	sh = wb.sheet_by_index(0)
	#user = sh.cell(0,1).value
	user = sys.argv[5]
	#chamber=sh.cell(10,1).value
	chamber=sys.argv[2]
	Run=sys.argv[3]
	location=sys.argv[4]
	Start=sys.argv[7]
	Stop=sys.argv[8]
	comment=sys.argv[6]
	Elog=sys.argv[9]
	File=sys.argv[10]
	Comment=sys.argv[11]
	pre = 'ORTEC 142PC'
	amp = sh.cell(4,1).value
	coa = sh.cell(5,1).value
	fine = sh.cell(6,1).value
	itime = sh.cell(7,1).value
	dtime = sh.cell(8,1).value
	disc = sh.cell(27,1).value
	thrs = sh.cell(28,1).value
	walk = sh.cell(29,1).value
	width = sh.cell(30,1).value
	scal = sh.cell(40,1).value
	daq = sh.cell(41,1).value
	pico = sh.cell(33,1).value
	tred = sh.cell(34,1).value
	tblack = sh.cell(35,1).value
	tgreen = sh.cell(36,1).value
	source = sh.cell(44,1).value
	hvlt = sh.cell(45,1).value
	current = sh.cell(46,1).value
	nbpri = sh.cell(23,5).value
	eta = sh.cell(12,1).value
	gas = sh.cell(13,1).value
	gfac = sh.cell(14,1).value
	flow = sh.cell(15,1).value
	req = sh.cell(16,1).value
	divi = sh.cell(17,1).value
	avtemp = sh.cell(47,5).value
	amb = sh.cell(48,5).value
	expo1 = sh.cell(49,5).value
	expo2= sh.cell(50,5).value
	expo3 = sh.cell(51,5).value
	expo4 = sh.cell(52,5).value
	rate1 = sh.cell(53,5).value
	root = generateXMLHeader("QC5_EFF_GAIN_CONFIG","GEM Chamber QC5 Effective Gain Config",str(location) + " GEM Chamber QC5 Effective Gain",Run,Start,Stop,comment,location,user)
	dataSet = generateDataSet(root,Comment,"1","GEM Chamber",chamber)
	generateXMLData5a(dataSet,str(user),pre,str(amp),str(coa), str(fine), str(itime),str(dtime),str(disc),str(thrs),str(walk),str(width),str(scal),str(daq),str(pico),str(tred),str(tblack),str(tgreen),str(source),str(hvlt),str(current),str(nbpri),str(eta),str(gas),str(gfac),str(flow),str(req),str(divi))
	writeToFile(fileName, tostring(root))
	
	root = generateXMLHeader("QC5_EFF_GAIN_DATA","GEM Chamber QC5 Effective Gain Data","BGEM Chamber QC5 Effective Gain ",Run,Start,Stop,comment,location,user)
	dataSet = generateDataSet(root,Comment,"1","GEM Chamber",chamber)
	for row in range(29,sh.nrows):
		if sh.row_values(row)[4]=='':
		#if row == 45:
			break
		test_time=Start
		humidity='32'
		vmon= sh.row_values(row)[5]
		imon= sh.row_values(row)[4]
		#time= sh.row_values(row)[7]
		#pressure= sh.row_values(row)[8]
		#temp= sh.row_values(row)[9]
		vdrift= sh.row_values(row)[6]
		pressure= '969'
		temp= '21.8'
		s_count= sh.row_values(row)[7]
		s_error= sh.row_values(row)[8]
		off_count= sh.row_values(row)[9]
		off_error= sh.row_values(row)[10]
		s_current= sh.row_values(row)[11]
		s_current_error= sh.row_values(row)[12]
		#off_current= sh.row_values(row)[13]
		#off_current_error= sh.row_values(row)[17]
		generateXMLData5(dataSet,str(test_time),str(temp),str(pressure),str(humidity), str(imon), str(vmon),str(vdrift),str(s_count),str(s_error),str(off_count),str(off_error),str(s_current),str(s_current_error))
		writeToFile(datafile, tostring(root))
	root = generateXMLHeader("QC5_EFF_GAIN_SUMRY","GEM Chamber QC5 Effective Gain Summary","BGEM Chamber QC5 Effective Gain Summary",Run,Start,Stop,comment,location,user)
	dataSet = generateDataSet(root,Comment,"1","GEM Chamber",chamber)
	generateXMLData5s(dataSet,str(test_time),str(avtemp), str(amb),str(expo1),str(expo2),str(expo3),str(expo4),str(rate1),str(File),str(Elog),str(Comment))	
	writeToFile(testfile, tostring(root))

if __name__ =="__main__":	
	#fname=raw_input("Enter excel data file name:")
	fname = sys.argv[1]
	fileName=fname+".xml"
	datafile=fname+"_Data.xml"
	testfile=fname+"_summry.xml"
	xml_from_excel5(fname)
