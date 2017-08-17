#!/usr/bin/env python
from datetime import datetime,date,time
from xml.etree.ElementTree import Element, SubElement, Comment, tostring
import time
import re
import sys
#import statistics
from xmlConversion import generateXMLHeader, generateDataSet, writeToFile,writeToFile1
from xmlConversion import generateXMLDatafastamb,generateXMLDatafast,generateXMLDatalongamb,generateXMLDatalong, generateXMLData3,generateXMLData3a,generateXMLData4,generateXMLData4a,generateXMLData5a,generateXMLData5,generateXMLData4s
import json
import cx_Oracle
chamber=sys.argv[1]
#con = cx_Oracle.connect('CMS_GEM_APPUSER_R/GEM_Reader_2015@int2r')
con = cx_Oracle.connect('CMS_COND_GENERAL_R/p3105rof@cms_omds_adg')
cur = con.cursor()

Run=cur.execute("select nvl(max(run.RUN_NUMBER), 0) + 1 from cms_gem_core_cond.cond_data_sets dat join cms_gem_core_cond.kinds_of_conditions koc on dat.KIND_OF_CONDITION_ID = koc.KIND_OF_CONDITION_ID join CMS_GEM_CORE_CONSTRUCT.PARTS par on par.PART_ID = dat.PART_ID join CMS_GEM_CORE_COND.COND_RUNS run on dat.COND_RUN_ID = run.COND_RUN_ID where koc.IS_RECORD_DELETED = 'F' and par.IS_RECORD_DELETED = 'F' and koc.name = 'GEM Drift PCB QC1 HV Drift Data' and par.SERIAL_NUMBER = '"+chamber+"'")
#Run = [ t for t, in Run ]
#print Run[0]
