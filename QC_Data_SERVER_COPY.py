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

db = create_engine('oracle://CMS_GEM_APPUSER_R:GEM_Reader_2015@(DESCRIPTION=(ADDRESS= (PROTOCOL=TCP) (HOST=int2r1-s.cern.ch) (PORT=10121) )(LOAD_BALANCE=on)(ENABLE=BROKEN)(CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=int2r.cern.ch)))')
#con = cx_Oracle.connect('CMS_GEM_APPUSER_R/GEM_Reader_2015@int2r.cern.ch')
#con = cx_Oracle.connect('CMS_COND_GENERAL_R/p3105rof@cms_omds_adg')
#cur = con.cursor()

#table=cur.execute("select unique table_name from all_all_tables where table_name like '%QC2%'")
#table=db.engine.execute("select unique table_name from all_all_tables where table_name like '%QC2%'")#for t in table:
#testname = [ t for t, in table ]
##print testname[0] 

def ObtainDate(ask,formT):
    isValid=False
    return "PLACEHOLDER_DATE"
    while not isValid:
        userIn = raw_input(ask)#"Type Date: yyyy-mm-dd: ")
        try:
            d1 = datetime.strptime(userIn, formT)#"%Y-%m-%d")
            isValid=True
        except:
            #print "Invalid Format!\n"
			pass
    return d1

#ch=int(raw_input("Press 2 for QC2 Test 3 for QC3 Test and 4 for QC4 Test 5 for QC5 Test and 6 for QC6 Test:"))
ch=3
#Run=raw_input("Run Number:")
#Start=str(ObtainDate("Test Start Time(with Date like 2017-01-16):","%Y-%m-%d %H:%M:%S"))
#Stop=str(ObtainDate("Test End Time:","%Y-%m-%d %H:%M:%S"))
#comment=raw_input("Comment:")
#location=raw_input("Location:")
#user=raw_input("User:")
#chamber=raw_input("Please Enter Chamber Name:")
#QC2
if ch==2:
	select= int(raw_input("Press 1 for QC2 Fast Test and 2 for Long Test:"))
	
	if select==1:
		def xml_from_excel2(excel_file):
			wb = xlrd.open_workbook(excel_file)
			sh = wb.sheet_by_index(0)
			tags = [n.replace(" ", "").lower() for n in sh.row_values(0)]
			Start=str(ObtainDate("Test Start Time(with Date like 2017-01-16):","%Y-%m-%d %H:%M:%S"))
			#print "Test Start At:" +str(Start)
			Stop=str(ObtainDate("Test End Time:","%Y-%m-%d %H:%M:%S"))
			#print "Test Stop At:" +str(Stop)
			foil=sh.cell(0,1).value
			Date=sh.cell(1,1).value
			location=sh.cell(3,1).value
			#print "Test Done At:"+str(location)
			comment=raw_input("Make a Comment:")
			user=sh.cell(6,1).value
			#print "Test Performed By:"+str(user)
			humidity = sh.cell(2,1).value
			Run=db.engine.execute("select nvl(max(run.RUN_NUMBER), 0) + 1 from cms_gem_core_cond.cond_data_sets dat join cms_gem_core_cond.kinds_of_conditions koc on dat.KIND_OF_CONDITION_ID = koc.KIND_OF_CONDITION_ID join CMS_GEM_CORE_CONSTRUCT.PARTS par on par.PART_ID = dat.PART_ID join CMS_GEM_CORE_COND.COND_RUNS run on dat.COND_RUN_ID = run.COND_RUN_ID where koc.IS_RECORD_DELETED = 'F' and par.IS_RECORD_DELETED = 'F' and koc.name = '' and par.SERIAL_NUMBER = '"+foil+"'")
			Run = [ t for t, in Run ] 
			#print "Number of Time Test Done:" +str(Run)
			root = generateXMLHeader("FOIL_QC2_FAST_AMB_COND","GEM Foil QC2 Fast Test Ambient Condition","CERN MPT GEM Foil QC2 Fast Test Data",str(Run[0]),Start,Stop,comment,location,user)
			dataSet = generateDataSet(root,"GEM Foil QC2 Fast Test Data ","1","GEM Foil",foil)
			generateXMLDatafastamb(dataSet,humidity)
			writeToFile1(testfile, tostring(root))
			root = generateXMLHeader("FOIL_QC2_FAST_TEST","GEM Foil QC2 Fast Test Data","GEM Foil QC2 Fast Test Data",Run[0],Start,Stop,comment,location,user)
			dataSet = generateDataSet(root,"GEM Foil QC2 Fast Test Data ","1","GEM Foil",foil)
			for row in range(12,sh.nrows):
				time=sh.row_values(row)[0]
				volt=sh.row_values(row)[1]
				impedence=sh.row_values(row)[2]
				current=sh.row_values(row)[3]
				sparks=sh.row_values(row)[4]
				totalspark=sh.row_values(row)[5]
				generateXMLDatafast(dataSet,str(times),str(volt),str(impedence),str(current),str(sparks),str(totalsparks))
				writeToFile(fileName,tostring(root))
	if select==2:
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

#QC3
if ch==3:
	#select=int(raw_input("Press 1 for Calibration Test and 2 for Leak Test :"))
	select = 1	
	if select==1:
		def xml_from_excel3(excel_file):
			wb = xlrd.open_workbook(excel_file)
			sh = wb.sheet_by_index(0)
			tags = [n.replace(" ", "").lower() for n in sh.row_values(0)]
			Start=str(ObtainDate("Test Start Time(with Date like 2017-01-16):","%Y-%m-%d %H:%M:%S"))
			#print "Test Start At:" +str(Start)
			Stop=str(ObtainDate("Test End Time:","%Y-%m-%d %H:%M:%S"))
			#print "Test End At:" + str(Stop)
			chamber=sh.cell(2,7).value
			#print "Chamber is selected:" +str(chamber)
			#Date=sh.cell(0,7).value
			Date=str(Start[0:10])
			##print Date
			#location=raw_input("Enter Location:")
			location = "PLACEHOLDER_LOCATION"
			#print "Test Done At:"+str(location)
			user=sh.cell(1,7).value
			#print "Test Done By:" +str(user)
			#comment=raw_input("Make a Comment:")
			comment = "PLACHOLDER_COMMENT"
			#print "Here what you Comment:" +str(comment)
			Run=db.engine.execute("select nvl(max(run.RUN_NUMBER), 0) + 1 from cms_gem_core_cond.cond_data_sets dat join cms_gem_core_cond.kinds_of_conditions koc on dat.KIND_OF_CONDITION_ID = koc.KIND_OF_CONDITION_ID join CMS_GEM_CORE_CONSTRUCT.PARTS par on par.PART_ID = dat.PART_ID join CMS_GEM_CORE_COND.COND_RUNS run on dat.COND_RUN_ID = run.COND_RUN_ID where koc.IS_RECORD_DELETED = 'F' and par.IS_RECORD_DELETED = 'F' and koc.name = '' and par.SERIAL_NUMBER = '"+chamber+"'")
			Run = [ t for t, in Run ]
			#print "Number of Time Test Perform:"+str(Run[0])
			root = generateXMLHeader("QC3_GAS_LEAK_CALIB","GEM Chamber QC3 Gas Leak Calib Data","CERN Station A GEM Chamber QC3 Gas Leak Calibration",str(Run[0]),Start,Stop,comment,location,user)
			dataSet = generateDataSet(root,"GEM Chamber QC3 Gas Leak Calib Data","1","GEM Chamber",chamber)	
			for row in range(1,sh.nrows):
					seconds= sh.row_values(row)[1]
					pre= sh.row_values(row)[2]
					temp =sh.row_values(row)[3]
					ambp= sh.row_values(row)[4]
					#times=datetime.strftime(sh.row_values(row)[0], '%H:%M:%S')
					times = xlrd.xldate_as_tuple(sh.row_values(row)[0], wb.datemode)
					##print times[3:]
					times=str(times).replace(",",":")
					times = str(times).replace(")","")
					times = str(times).replace("("," ")
					##print times
					generateXMLData3(dataSet,Date +str(times[9:]),str(seconds),str(pre), str(ambp), str(temp))
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
			#elog=raw_input("Please Enter the ELOG LINK:")
			#File=raw_input("Please Enter the File Name:")
			#Comments=raw_input("Make a Summary Comment:")
			elog="PLACEHOLDER_ELOG"
			File="PLACEHOLDER_FILE"
			Comments="PLACHOLDER_COMMENTS"
			root = generateXMLHeader("QC3_GAS_LEAK_CalIB_SUMMARY","GEM Chamber QC3 Gas Leak Calib Summary ","CERN Station A GEM Chamber QC3 Gas Leak Calib Summary",str(Run[0]),Start,Stop,comment, location,user)
			dataSet = generateDataSet(root,"GEM Chamber QC3 Gas Leak Calib Summary","1","GEM Chamber",chamber)
			generateXMLData3a(dataSet, str(test_date) ,str(avgtemp),str(stdtemp),str(avgpre),str(stdpre),str(initpre),str(finalpre),str(duration),str(leakrate),str(expofitp0),str(expofitp1),str(expofitR2),str(elog),str(File),str(Comments))
			writeToFile1(testfile, tostring(root))
	if select==2:	
		def xml_from_excel3(excel_file):
			wb = xlrd.open_workbook(excel_file)
			sh = wb.sheet_by_index(0)
			#tags = [n.replace(" ", "").lower() for n in sh.row_values(0)]
			Start=str(ObtainDate("Test Start Time(with Date like 2017-01-16):","%Y-%m-%d %H:%M:%S"))
			#print "Test Start At:" +str(Start)
			Stop=str(ObtainDate("Test End Time:","%Y-%m-%d %H:%M:%S"))
			#print "Test End At:" + str(Stop)
			chamber=sh.cell(2,7).value
			#print "Chamber is selected:" +str(chamber)
			#Date=sh.cell(0,7).value
			Date=str(Start[0:10])
			##print Date
			location=raw_input("Enter Location:")
			#print "Test Done At:"+str(location)
			user=sh.cell(1,7).value
			#print "Test Done By:" +str(user)
			comment=raw_input("Make a Comment:")
			#print "Here what you Comment:" +str(comment)
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

#QC4
if ch==4:
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
		Start=str(ObtainDate("Test Start Time(with Date like 2017-01-16):","%Y-%m-%d %H:%M:%S"))
		#print "Test Start At:" +str(Start)
		Stop=str(ObtainDate("Test End Time:","%Y-%m-%d %H:%M:%S"))
		#print "Test End At:" + str(Stop)
		chamber=raw_input("Please Enter a Chamber Name:")
		#print "Chamber is selected:" +str(chamber)
		#Date=sh.cell(0,7).value
		Date=str(Start[0:10])
		##print Date
		location=raw_input("Enter Location:")
		#print "Test Done At:"+str(location)
		user=sh.cell(1,7).value
		#print "Test Done By:" +str(user)
		comment=raw_input("Make a Comment:")
		#print "Here what you Comment:" +str(comment)
		Run=db.engine.execute("select nvl(max(run.RUN_NUMBER), 0) + 1 from cms_gem_core_cond.cond_data_sets dat join cms_gem_core_cond.kinds_of_conditions koc on dat.KIND_OF_CONDITION_ID = koc.KIND_OF_CONDITION_ID join CMS_GEM_CORE_CONSTRUCT.PARTS par on par.PART_ID = dat.PART_ID join CMS_GEM_CORE_COND.COND_RUNS run on dat.COND_RUN_ID = run.COND_RUN_ID where koc.IS_RECORD_DELETED = 'F' and par.IS_RECORD_DELETED = 'F' and koc.name = '' and par.SERIAL_NUMBER = '"+chamber+"'")
		Run = [ t for t, in Run ]
		#print "Number of Time Test Perform:"+str(Run[0])
		root = generateXMLHeader("QC4_HVTEST_CONFIG","GEM Chamber QC4 HV TEST Configuration","CERN Station A GEM QC4 HV Test",Run,Start,Stop,comment,location,user)
		dataSet = generateDataSet(root,"GEM Chamber QC4 HV TEST Configuration","1","GEM Chamber",chamber)
		generateXMLData4a(dataSet,str(req), str(pre),str(amp),str(coa), str(fine), str(itime),str(dtime),str(disc),str(thrs),str(scal),str(daq))
		writeToFile(fileName, tostring(root))
		root = generateXMLHeader("QC4_HVTEST_DATA","GEM Chamber QC4 HVTEST Data","CERN Station A GEM QC4 HV Test",Run,Start,Stop,comment,location,user)
		dataSet = generateDataSet(root,"GEM Chamber QC4 HVTEST Data","1","GEM Chamber",chamber)
		for row in range(3, sh.nrows):
			if row == 37:
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
		test_date=str(Start[0:10])
		v_drift = sh.cell(26,16).value
		i_max = sh.cell(27,16).value
		r_euq = sh.cell(28,16).value
		r_err= sh.cell(29,16).value
		r_diff = sh.cell(30,16).value
		spr_signal = sh.cell(31,16).value
		spr_error = sh.cell(32,16).value
		Filename= raw_input("Please Enter the FileName:")
		Elog=raw_input("Please Enter the Elog Link:")
		Comment=raw_input("Write a Summary Comment:")
		root = generateXMLHeader("QC4_HVTEST_SUMMARY","GEM Chamber QC4 HVTEST Summary","CERN Station A GEM QC4 HV Test Summary",Run,Start,Stop,Comment,location,user)
		dataSet = generateDataSet(root,"GEM Chamber QC4 HVTEST Summary","1","GEM Chamber",chamber)
		generateXMLData4s(dataSet,str(test_time),str(v_max),str(i_max),str(v_drift),str(r_euq), str(r_err), str(r_diff),str(spr_signal),str(Filename),str(Elog),str(Comment))
		writeToFile(testfile, tostring(root))

#QC5
if ch==5:
	def xml_from_excel5(excel_file):
		wb = xlrd.open_workbook(excel_file)
		sh = wb.sheet_by_index(0)
		user = sh.cell(0,1).value
		chamber=sh.cell(10,1).value
		pre = raw_input("Please Enter Preamplifier Name:")
		amp = sh.cell(3,1).value
		coa = sh.cell(4,1).value
		fine = sh.cell(5,1).value
		itime = sh.cell(6,1).value
		dtime = sh.cell(7,1).value
		disc = sh.cell(26,1).value
		thrs = sh.cell(27,1).value
		walk = sh.cell(28,1).value
		width = sh.cell(29,1).value
		scal = sh.cell(39,1).value
		daq = sh.cell(40,1).value
		pico = sh.cell(32,1).value
		tred = sh.cell(33,1).value
		tblack = sh.cell(34,1).value
		tgreen = sh.cell(35,1).value
		source = sh.cell(43,1).value
		hvlt = sh.cell(44,1).value
		current = sh.cell(45,1).value
		nbpri = "346"
		eta = sh.cell(11,1).value
		gas = sh.cell(12,1).value
		gfac = sh.cell(13,1).value
		flow = sh.cell(14,1).value
		req = sh.cell(15,1).value
		divi = sh.cell(16,1).value
		root = generateXMLHeader("QC5_GAIN_STBLTY_CONFIG","GEM Chamber QC5 Gain Stability","CERN Station A GEM Chamber QC5 Gain Stability",Run,Start,Stop,comment,location,user)
		dataSet = generateDataSet(root,"GEM Chamber QC5 Gain Stability Config","1","GEM Chamber",chamber)
		generateXMLData5a(dataSet,str(user),pre,str(amp),str(coa), str(fine), str(itime),str(dtime),str(disc),str(thrs),str(walk),str(width),str(scal),str(daq),str(pico),str(tred),str(tblack),str(tgreen),str(source),str(hvlt),str(current),str(nbpri),str(eta),str(gas),str(gfac),str(flow),str(req),str(divi))
		writeToFile(fileName, tostring(root))
	
		root = generateXMLHeader("QC5_GAIN_STBLTY_DATA","GEM Chamber QC5 Gain Stability Data","CERN Station A GEM Chamber QC5 Gain Stability",Run,Start,Stop,comment,location,user)
		dataSet = generateDataSet(root,"GEM Chamber QC5 Gain Stability Data","1","GEM Chamber",chamber)
		for row in range(6,sh.nrows):
			if row ==33:
				break
			test_time=str(Start[0:10])
			humidity=raw_input("Please write Humidity Value:")
			vmon= sh.row_values(row)[5]
			imon= sh.row_values(row)[6]
			time= sh.row_values(row)[21]
			pressure= sh.row_values(row)[22]
			temp= sh.row_values(row)[23]
			s_count= sh.row_values(row)[24]
			s_error= sh.row_values(row)[25]
			off_count= sh.row_values(row)[26]
			off_error= sh.row_values(row)[27]
			s_current= sh.row_values(row)[28]
			s_current_error= sh.row_values(row)[29]
			off_current= sh.row_values(row)[30]
			off_current_error= sh.row_values(row)[31]
			generateXMLData5(dataSet,str(test_time),str(temp),str(pressure),str(humidity), str(imon), str(vmon),str(s_count),str(s_error),str(off_count),str(off_error),str(s_current),str(s_current_error),str(off_current))
			writeToFile(datafile, tostring(root))
		#root = generateXMLHeader("QC5_GAIN_STBLTY_DATA_SUMMARY","GEM Chamber QC5 Gain Stability Data Summary","CERN Station A GEM Chamber QC5 Gain Stability Summary",Run,Start,Stop,comment,location,user)
		#dataSet = generateDataSet(root,"GEM Chamber QC5 Gain Stability Data Summary","1","GEM Chamber",chamber)
		
#QC6
if ch==6:
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
		root = generateXMLHeader("QC6_HVTEST_CONFIG","GEM Chamber QC6 HV TEST Configuration","CERN Station A GEM QC6 HV Test",Run,Start,Stop,comment,location,user)
		dataSet = generateDataSet(root,"GEM Chamber QC6 HV TEST Configuration","1","GEM Chamber",chamber)
		generateXMLData4a(dataSet,str(req), str(pre),str(amp),str(coa), str(fine), str(itime),str(dtime),str(disc),str(thrs),str(scal),str(daq))
		writeToFile(fileName, tostring(root))
		root = generateXMLHeader("QC6_HVTEST_DATA","GEM Chamber QC6 HVTEST Data","CERN Station A GEM QC6 HV Test",Run,Start,Stop,comment,location,user)
		dataSet = generateDataSet(root,"GEM Chamber QC6 HVTEST Data","1","GEM Chamber",chamber)
		for row in range(3, sh.nrows):
			if row == 37:
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
		test_time="2016-11-07"
		v_drift = sh.cell(26,16).value
		i_max = sh.cell(27,16).value
		r_euq = sh.cell(28,16).value
		r_err= sh.cell(29,16).value
		r_diff = sh.cell(30,16).value
		spr_signal = sh.cell(31,16).value
		spr_error = sh.cell(32,16).value
		Filename= raw_input("Please Enter the FileName:")
		Elog=raw_input("Please Enter the Elog Link:")
		Comment=raw_input("Please Enter the comment:")
		root = generateXMLHeader("QC6_HVTEST_DATA_SUMMARY","GEM Chamber QC6 HVTEST Data Summary","CERN Station A GEM QC6 HV Test Summary",Run,Start,Stop,comment,location,user)
		dataSet = generateDataSet(root,"GEM Chamber QC6 HVTEST Data Summary","1","GEM Chamber",chamber)
		generateXMLData4s(dataSet,str(test_time),str(v_max),str(i_max),str(v_drift),str(r_euq), str(r_err), str(r_diff),str(spr_signal),str(Filename),str(Elog),str(Comment))
		writeToFile(testfile, tostring(root))


if __name__ =="__main__":	
	#fname=raw_input("Enter excel data file name:")
	fname = sys.argv[1]
	fileName=fname+".xml"
	datafile=fname+"_Data.xml"
	testfile=fname+"_summry.xml"
	if ch==2:
		if select==1:
			xml_from_excel2(fname)
		if select==2:
			xml_from_excellong(fname)
	if ch==3:
		xml_from_excel3(fname)	
	if ch==4:
			xml_from_excel4(fname)
	if ch==5:
			xml_from_excel5(fname)
	if ch==6:
			xml_from_excel4(fname)
