#!/usr/bin/env python
from datetime import datetime,date,time
#from time import sleep
from xml.etree.ElementTree import Element, SubElement, Comment, tostring
#import serial
import time
#import xlrd
#from xlrd import xldate
import re
import sys
#import statistics
from xmlConversion import generateXMLHeader, generateDataSet, writeToFile,writeToFile1
from xmlConversion import generateXMLDatafastamb,generateXMLDatafast,generateXMLDatalongamb,generateXMLDatalong, generateXMLData3,generateXMLData3a,generateXMLData4,generateXMLData4a,generateXMLData5a,generateXMLData5,generateXMLData4s
import json
#from flask import Flask, render_template
#from flask_sqlalchemy import SQLAlchemy
#from sqlalchemy import create_engine, MetaData, Table, and_
#from sqlalchemy.sql import select
import cx_Oracle
foils=sys.argv[1]
#con = cx_Oracle.connect('CMS_GEM_APPUSER_R/GEM_Reader_2015@int2r')
con = cx_Oracle.connect('CMS_COND_GENERAL_R/p3105rof@cms_omds_adg')
cur = con.cursor()
#Run=cur.execute("select nvl(max(run.RUN_NUMBER), 0) + 1 from cms_gem_core_cond.cond_data_sets dat join cms_gem_core_cond.kinds_of_conditions koc on dat.KIND_OF_CONDITION_ID = koc.KIND_OF_CONDITION_ID join CMS_GEM_CORE_CONSTRUCT.PARTS par on par.PART_ID = dat.PART_ID join CMS_GEM_CORE_COND.COND_RUNS run on dat.COND_RUN_ID = run.COND_RUN_ID where koc.IS_RECORD_DELETED = 'F' and par.IS_RECORD_DELETED = 'F' and koc.name = 'GEM Chamber QC3 Gas Leak Data' and par.SERIAL_NUMBER = '"+chamber+"'")

Run=cur.execute("select nvl(max(run.RUN_NUMBER), 0) + 1 from cms_gem_core_cond.cond_data_sets dat join cms_gem_core_cond.kinds_of_conditions koc on dat.KIND_OF_CONDITION_ID = koc.KIND_OF_CONDITION_ID join CMS_GEM_CORE_CONSTRUCT.PARTS par on par.PART_ID = dat.PART_ID join CMS_GEM_CORE_COND.COND_RUNS run on dat.COND_RUN_ID = run.COND_RUN_ID where koc.IS_RECORD_DELETED = 'F' and par.IS_RECORD_DELETED = 'F' and koc.name = 'GEM Foil QC2 Fast Test Data' and par.SERIAL_NUMBER = '"+foils+"'")
#Run=cur.execute("select nvl(max(run.RUN_NUMBER), 0) + 1 from cms_gem_core_cond.cond_data_sets dat join cms_gem_core_cond.kinds_of_conditions koc on dat.KIND_OF_CONDITION_ID = koc.KIND_OF_CONDITION_ID join CMS_GEM_CORE_CONSTRUCT.PARTS par on par.PART_ID = dat.PART_ID join CMS_GEM_CORE_COND.COND_RUNS run on dat.COND_RUN_ID = run.COND_RUN_ID where koc.IS_RECORD_DELETED = 'F' and par.IS_RECORD_DELETED = 'F' and koc.name = '' and par.SERIAL_NUMBER = '"+chamber+"'")
#Run=cur.execute("select nvl(max(run.RUN_NUMBER), 0) + 1 from cms_gem_core_cond.cond_data_sets dat join cms_gem_core_cond.kinds_of_conditions koc on dat.KIND_OF_CONDITION_ID = koc.KIND_OF_CONDITION_ID join CMS_GEM_CORE_CONSTRUCT.PARTS par on par.PART_ID = dat.PART_ID join CMS_GEM_CORE_COND.COND_RUNS run on dat.COND_RUN_ID = run.COND_RUN_ID where koc.IS_RECORD_DELETED = 'F' and par.IS_RECORD_DELETED = 'F' and koc.name = 'GEM Chamber QC3 Gas Leak Calib Data' and par.SERIAL_NUMBER = 'GE1/1-VII-L-CERN-0001'")
Run = [ t for t, in Run ]
print Run[0]
