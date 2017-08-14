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

def xml_from_excellong(excel_file):
	Start=str(ObtainDate("Test Start Time(with Date like 2017-01-16):","%Y-%m-%d %H:%M:%S"))
	Stop=str(ObtainDate("Test End Time:","%Y-%m-%d %H:%M:%S"))
	comment=raw_input("Comment:")
	location=raw_input("Location:")
	user=raw_input("User:")
	foil=raw_input("Please Enter Chamber Name:")
	Run=db.engine.execute("select nvl(max(run.RUN_NUMBER), 0) + 1 from cms_gem_core_cond.cond_data_sets dat join cms_gem_core_cond.kinds_of_conditions koc on dat.KIND_OF_CONDITION_ID = koc.KIND_OF_CONDITION_ID join CMS_GEM_CORE_CONSTRUCT.PARTS par on par.PART_ID = dat.PART_ID join CMS_GEM_CORE_COND.COND_RUNS run on dat.COND_RUN_ID = run.COND_RUN_ID where koc.IS_RECORD_DELETED = 'F' and par.IS_RECORD_DELETED = 'F' and koc.name = '' and par.SERIAL_NUMBER = '"+foil+"'")
	Run = [ t for t, in Run ]
	root = generateXMLHeader("FOIL_QC2_LONG_AMB_COND","GEM QC2 Long Foil Test Conditions Data","CERN GEM Foil QC2 Long Test Batch 7",str(Run[0]),Start,Stop,comment,location,user)
	dataSet = generateDataSet(root,"GEM Foil QC2 Long Test COnditions","1","GEM Foil",foil)
	relhumi=raw_input("Enter the Humidity:")
	tempreature=raw_input("Enter tempreature")
	lines = excel_file
	for line in lines:
		#print line
		if line[0] == "#":
			continue
		else:
			inner_list = [elt.strip() for elt in line.split('\t')]
		root = generateXMLHeader("FOIL_QC2_LONG_TEST","GEM Foil QC2 Long Test Data","GEM Foil QC2 Long Test Data",str(Run[0]),Start,Stop,comment,location,user)
		dataSet = generateDataSet(root,"GEM Foil QC2 Long Test Data ","1","GEM Foil",foil)
		generateXMLDatafast(dataSet,[0],inner_list[1],inner_list[2],inner_list[3],inner_list[4],inner_list[5])
		writeToFile(fileName,tostring(root))


if __name__ =="__main__":	
	#fname=raw_input("Enter excel data file name:")
	fname = sys.argv[1]
	fileName=fname+".xml"
	datafile=fname+"_Data.xml"
	testfile=fname+"_summry.xml"
	xml_from_excellong(fname)
