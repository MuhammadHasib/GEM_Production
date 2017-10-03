from __future__ import division
import argparse
from xml.etree.ElementTree import Element, SubElement, Comment, tostring
from xml.dom import minidom
from xml.etree import ElementTree
from datetime import datetime
import sys

def writeToFile(path, lines):
    with open(path, mode='w+') as myfile:
        myfile.write(lines)

def writeToFile1(path, lines):
    with open(path, mode='w+') as myfile:
        myfile.write(lines)

def readFile(path):
    with open(path) as f:
	    lines=f.readlines()
    return lines


def generateXMLHeader(extensionTableNameText, nameText, runTypeText, runNumberText, runBeginText, runEndText, commentText, locationText, userText):
    root = Element('ROOT')
    root.set('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance')
    header = SubElement(root, 'HEADER')
    type = SubElement(header, 'TYPE')
    extensionTableName = SubElement(type, 'EXTENSION_TABLE_NAME')
    extensionTableName.text = extensionTableNameText
    name = SubElement(type, 'NAME')
    name.text = nameText
    run = SubElement(header, 'RUN')
    runType= SubElement(run, 'RUN_TYPE')
    runType.text= runTypeText
    runNumber = SubElement(run, 'RUN_NUMBER')
    runNumber.text= runNumberText
    runBegin = SubElement(run, 'RUN_BEGIN_TIMESTAMP')
    runBegin.text = runBeginText
    runEnd = SubElement(run,'RUN_END_TIMESTAMP')
    runEnd.text= runEndText
    comment = SubElement(run, 'COMMENT_DESCRIPTION')
    comment.text= commentText
    location = SubElement(run, 'LOCATION')
    location.text = locationText
    user = SubElement(run,'INITIATED_BY_USER')
    user.text = userText
    return root

def generateDataSet(Set,descriptionText,versionText,kindText,serialText):
    dataSet = SubElement(Set, 'DATA_SET')
    description = SubElement(dataSet, 'COMMENT_DESCRIPTION')
    description.text = descriptionText
    version = SubElement(dataSet,'VERSION')
    version.text = versionText
    part = SubElement(dataSet,"PART")
    kind = SubElement(part,"KIND_OF_PART")
    kind.text = kindText
    serial = SubElement(part,"SERIAL_NUMBER")
    serial.text = serialText
    return dataSet
#QC2
def generateXMLDatafastamb(dataSetTag,HumidityText):
    data = SubElement(dataSetTag, 'DATA')
    Humidity = SubElement(data, 'HUMIDITY_PERCENT')
    Humidity.text = HumidityText

def generateXMLDatafast(dataSetTag,timeMinutesText,appliedVoltageText,impedanceText,leakageText,sparksText,totsparksText):
    data = SubElement(dataSetTag, 'DATA')
    timeMinutes = SubElement(data, 'TIME_MINUTES')
    timeMinutes.text = timeMinutesText
    appliedVoltage = SubElement(data, 'APPLIED_VOLTAGE')
    appliedVoltage.text=appliedVoltageText
    impedance=SubElement(data,'IMPEDANCE_GOHMS')
    impedance.text=impedanceText
    leakage=SubElement(data, 'LEAKAGE_CURRENT_NA')
    leakage.text=leakageText
    sparks=SubElement(data,'NUM_SPARKS')
    sparks.text=sparksText
    totspark=SubElement(data, 'TOT_NUM_SPARKS')
    totspark.text=totsparksText

def generateXMLDatalongamb(dataSetTag,batchText,RelhumiText,TempdegText):
    data = SubElement(dataSetTag, 'DATA')
    batch = SubElement(data, 'BATCH')
    batch.text = batchText
    Relhumi = SubElement(data, 'REL_HUM_PRCNT')
    Relhumi.text = RelhumiText
    Tempdeg = SubElement(data, 'TEMP_DEG_C')
    Tempdeg.text = TempdegText
   
def generateXMLDatalong(dataSetTag,timesecext,appliedVoltageText,errvoltText,currentText,ErrText):
    data = SubElement(dataSetTag, 'DATA')
    timesec = SubElement(data, 'TIME_SEC')
    timesec.text = timesecText
    appliedVoltage = SubElement(data, 'HV_VOLTS')
    appliedVoltage.text=appliedVoltageText
    errvolt=SubElement(data,'ERR_HV_VOLTS')
    errvolt.text=errvoltText
    current=SubElement(data, 'CURRENT_MICRO_AMP')
    current.text=currentText
    Err=SubElement(data,'ERR_CURNT_MICRO_AMP')
    Err.text=ErrText
#QC3    
def generateXMLData3(dataSetTag,testperformText,timeincrementText,mainpressureText,ambpressureText,temperatureText):
    data = SubElement(dataSetTag, 'DATA')
    testperform = SubElement(data, 'TEST_TIME')
    testperform.text = testperformText
    timeincrement = SubElement(data, 'INCRMNT_SEC')
    timeincrement.text=timeincrementText
    mainpressure=SubElement(data,'MANF_PRSR_MBAR')
    mainpressure.text=mainpressureText
    ambpressure=SubElement(data, 'AMB_PRSR_MBAR')
    ambpressure.text=ambpressureText
    temperature=SubElement(data,'TEMP_DEGC')
    temperature.text=temperatureText
    
def generateXMLData3a(dataSetTag,testperformText,AvgambText,StdambText,AvgpreText,stdpreText,initpreText,finalpreText,durationText,leakText,expoText,expoleakText,expofitText,elogText,filenameText,commentText,):
    data = SubElement(dataSetTag, 'DATA')
    testperform = SubElement(data, 'TEST_DATE')
    testperform.text = testperformText
    Avgamb = SubElement(data, 'AVG_AMBTEMP_DEGC')
    Avgamb.text=AvgambText
    Stdamb = SubElement(data, 'STDDEV_AMBTEMP_DEGC')
    Stdamb.text = StdambText
    Avgpre = SubElement(data, 'AVG_AMBPRSR_MBAR')
    Avgpre.text=AvgpreText
    stdpre=SubElement(data,'STDDEV_AMBPRSR_MBAR')
    stdpre.text=stdpreText
    initpre=SubElement(data, 'INIT_PRSR_MBAR')
    initpre.text=initpreText
    finalpre=SubElement(data,'FINAL_PRSR_MBAR')
    finalpre.text=finalpreText
    duration=SubElement(data,'DURATION_HR')
    duration.text=durationText
    leak=SubElement(data, 'LEAK_RATE_MBAR_HR')
    leak.text=leakText
    expo=SubElement(data,'EXPO_FIT_P0_MBAR')
    expo.text=expoText
    expoleak=SubElement(data,'EXPO_FIT_LEAK_PARAM')
    expoleak.text=expoleakText
    expofit=SubElement(data,'EXPO_FIT_R2')
    expofit.text=expofitText
    elog=SubElement(data,'ELOG_LINK')
    elog.text=elogText
    filename=SubElement(data,'FILE_NAME')
    filename.text=filenameText
    comment=SubElement(data,'COMMENTS')
    comment.text=commentText
#QC4
def generateXMLData4(dataSetTag,timeMinutesText,appliedVoltageText,impedanceText,leakageText,sparksText,rnormText,totsparksText,rateText,errorText):
    data = SubElement(dataSetTag, 'DATA')
    timeMinutes = SubElement(data, 'VSET_VLT')
    timeMinutes.text = timeMinutesText
    appliedVoltage = SubElement(data, 'VMON_VLT')
    appliedVoltage.text=appliedVoltageText
    impedance=SubElement(data,'ISET_UA')
    impedance.text=impedanceText
    leakage=SubElement(data, 'IMON_UA')
    leakage.text=leakageText
    sparks=SubElement(data,'RCALC_MOHM')
    sparks.text=sparksText
    rnorm=SubElement(data, 'RNORM_MOHM')
    rnorm.text=rnormText
    totsparks=SubElement(data,'COUNTS')
    totsparks.text=totsparksText
    rate = SubElement(data, 'RATE_HZ')
    rate.text =rateText 
    error = SubElement(data, 'ERR_RATE_HZ')
    error.text=errorText
#QC4 Configuration
def generateXMLData4a(dataSetTag,timeMinutesText,appliedVoltageText,impedanceText,leakageText,sparksText,rnormText,totsparksText,rateText,errorText,scalText,daqText):
    data = SubElement(dataSetTag, 'DATA')
    timeMinutes = SubElement(data, 'REQUIV_MOHM_MSRD')
    timeMinutes.text = timeMinutesText
    appliedVoltage = SubElement(data, 'PREAMPLIFIER')
    appliedVoltage.text=appliedVoltageText
    impedance=SubElement(data,'AMPLIFIER')
    impedance.text=impedanceText
    leakage=SubElement(data, 'COARSE_GAIN')
    leakage.text=leakageText
    sparks=SubElement(data,'FINE_GAIN')
    sparks.text=sparksText
    rnorm=SubElement(data, 'INT_TIME_NS')
    rnorm.text=rnormText
    totsparks=SubElement(data,'DIFF_TIME_NS')
    totsparks.text=totsparksText
    rate = SubElement(data, 'DISCRIMINATOR')
    rate.text =rateText 
    error = SubElement(data, 'THRSHLD_MV')
    error.text=errorText
    scal = SubElement(data, 'SCALAR')
    scal.text=scalText
    daq = SubElement(data, 'DAQ_TIME_SEC')
    daq.text = daqText
def generateXMLData4s(dataSetTag,testperformText,VmaxText,CurrVmaxText,VdrftText,ReqmsrdText,ReqslpText,diffText,SprsglText,filenameText,elogText,commentText):
    data = SubElement(dataSetTag, 'DATA')
    testperform = SubElement(data, 'TEST_DATE')
    testperform.text = testperformText
    Vmax = SubElement(data, 'VMAX_VLT')
    Vmax.text=VmaxText
    CurrVmax = SubElement(data, 'CURNT_AT_VMAX_UA')
    CurrVmax.text = CurrVmaxText
    Vdrft = SubElement(data, 'VDRFT_VLT')
    Vdrft.text=VdrftText
    Reqmsrd=SubElement(data,'REQUIV_MOHM_MSRD')
    Reqmsrd.text=ReqmsrdText
    Reqslp=SubElement(data, 'REQUIV_MOHM_SLP')
    Reqslp.text=ReqslpText
    diff=SubElement(data,'DIFF_REQUIV_PRCNT')
    diff.text=diffText
    Sprsgl=SubElement(data,'SPR_SGNL_AT_VMAX_HZ')
    Sprsgl.text=SprsglText
    filename=SubElement(data,'FILE_NAME')
    filename.text=filenameText
    elog=SubElement(data,'ELOG_LINK')
    elog.text=elogText
    comment=SubElement(data,'COMMENTS')
    comment.text=commentText
#QC5
def generateXMLData5(dataSetTag,timeMinutesText,tempText,pressText,humiText,imonText,vmonText,vdrifText,rateText,errorText,currentText,cerrorText,gainText,gerrorText):
    data = SubElement(dataSetTag, 'DATA')
    timeMinutes = SubElement(data, 'TIME')
    timeMinutes.text = timeMinutesText
    temp = SubElement(data, 'TEMP_DEGG')
    temp.text=tempText
    press=SubElement(data,'PRESSURE_MBAR')
    press.text=pressText
    humi=SubElement(data, 'HUMIDITY_PRCNT')
    humi.text=humiText
    imon=SubElement(data,'IMON_UA')
    imon.text=imonText
    vmon=SubElement(data, 'VMON_VLT')
    vmon.text=vmonText
    vdrif=SubElement(data,'VDRIFT_VLT')
    vdrif.text=vdrifText
    rate = SubElement(data, 'RATE_HZ')
    rate.text =rateText 
    error = SubElement(data, 'RATE_ERROR_HZ')
    error.text=errorText
    current = SubElement(data, 'CURRENT_AMP')
    current.text=currentText
    cerror = SubElement(data, 'CURRENT_ERROR_AMP')
    cerror.text=cerrorText
    gain = SubElement(data, 'GAIN')
    gain.text=gainText
    gerror = SubElement(data, 'GAIN_ERROR')
    gerror.text=gerrorText
#QC5 Configuration
def generateXMLData5a(dataSetTag,userText,preampText,ampText,cgainText,fgainText,itimeText,dtimeText,discText,thrsText,wadjsText,widthText, scalText,daqText,picoText,tredText,tblackText,tgreenText,souText,hvltText,currentText,nbpriText,etaText,gasText,gfracText,flowText,reqText,diviText):
    data = SubElement(dataSetTag, 'DATA')
    user = SubElement(data, 'USER_NAME')
    user.text = userText
    preamp = SubElement(data, 'PREAMPLIFIER')
    preamp.text=preampText
    amp=SubElement(data,'AMPLIFIER')
    amp.text=ampText
    cgain=SubElement(data, 'COARSE_GAIN')
    cgain.text=cgainText
    fgain=SubElement(data,'FINE_GAIN')
    fgain.text=fgainText
    itime=SubElement(data, 'INT_TIME_NS')
    itime.text=itimeText
    dtime=SubElement(data,'DIFF_TIME_NS')
    dtime.text=dtimeText
    disc = SubElement(data, 'DISCRIMINATOR')
    disc.text =discText 
    thrs = SubElement(data, 'THRSHLD_MV')
    thrs.text=thrsText
    wadjs = SubElement(data, 'WALK_ADJUST_MV')
    wadjs.text = wadjsText
    width = SubElement(data, 'WIDTH_NS')
    width.text = widthText 
    scal = SubElement(data, 'SCALAR')
    scal.text=scalText
    daq = SubElement(data, 'DAQ_TIME_SEC')
    daq.text = daqText
    pico = SubElement(data, 'PICOAMMETER')
    pico.text = picoText
    tred = SubElement(data, 'TRIAX_RED')
    tred.text = tredText
    tblack = SubElement(data, 'TRIAX_BLACK')
    tblack.text = tblackText
    tgreen = SubElement(data, 'TRIAX_GREEN')
    tgreen.text = tgreenText
    sou = SubElement(data, 'SOURCE')
    sou.text = souText
    hvlt = SubElement(data, 'HV_VLT')
    hvlt.text = hvltText
    current = SubElement(data, 'CURRENT_UA')
    current.text = currentText
    nbpri = SubElement(data, 'NB_PRIMARIES')
    nbpri.text = nbpriText
    eta = SubElement(data, 'ETA_SECTOR')
    eta.text = etaText
    gas = SubElement(data, 'GAS')
    gas.text = gasText
    gfrac = SubElement(data, 'GAS_FRAC')
    gfrac.text = gfracText
    flow = SubElement(data, 'FLOW_RATE_LHR')
    flow.text = flowText
    req = SubElement(data,'REQUIV_MOHM_MSRD')
    req.text = reqText
    divi = SubElement(data, 'REDIVIDER_MOHM_MSRD')
    divi.text = diviText
    
def generateXMLData5s(dataSetTag,timeText, AvgambText,AvgpreText,expofitText,expofit2Text,expofit3Text,expofit4Text,rateText,filesText,elogText,commentText):
	data = SubElement(dataSetTag, 'DATA')
	time = SubElement(data, 'TEST_DATE')
	time.text=timeText
	Avgamb = SubElement(data, 'AVG_TEMP_DEGC')
	Avgamb.text=AvgambText
	Avgpre=SubElement(data,'AVG_PRESSURE_MBAR')
	Avgpre.text=AvgpreText
	expofit=SubElement(data,'EXPO_FIT1_PARA1')
	expofit.text=expofitText
	expofit2=SubElement(data,'EXPO_FIT1_PARA2')
	expofit2.text=expofit2Text
	expofit3=SubElement(data,'EXPO_FIT2_PARA1')
	expofit3.text=expofit3Text
	expofit4=SubElement(data,'EXPO_FIT2_PARA2')
	expofit4.text=expofit4Text
	rate=SubElement(data,'RATE_MAXV_HZ')
	rate.text=rateText
	files=SubElement(data,'FILE_NAME')
	files.text=filesText
	elog=SubElement(data,'ELOG_LINK')
	elog.text=elogText
	comment=SubElement(data,'COMMENTS')
	comment.text=commentText
        
def generateXMLData6s(dataSetTag,testperformText,VmaxText,CurrVmaxText,VdrftText,ReqmsrdText,ReqslpText,diffText,sprsglText,tripText,filenameText,elogText,commentText,):
    data = SubElement(dataSetTag, 'DATA')
    testperform = SubElement(data, 'STARTING_TIME')
    testperform.text = testperformText
    Vmax = SubElement(data, 'ENDING_TIME')
    Vmax.text=VmaxText
    CurrVmax = SubElement(data, 'STABILITY_TIME_HR')
    CurrVmax.text = CurrVmaxText
    Vdrft = SubElement(data, 'STABILITY_VSET_VLT')
    Vdrft.text=VdrftText
    Reqmsrd=SubElement(data,'STABILITY_VMON_VLT')
    Reqmsrd.text=ReqmsrdText
    Reqslp=SubElement(data, 'STABILITY_ISET_UA')
    Reqslp.text=ReqslpText
    diff=SubElement(data,'STABILITY_IMON_UA')
    diff.text=diffText
    Sprsgl=SubElement(data,'STABILITY_VDRFT_VLT')
    Sprsgl.text=SprsglText
    trip= SubElement(data,'TRIP_TIME_SEC')
    trip.text=tripText
    filename=SubElement(data,'FILE_NAME')
    filename.text=filenameText
    elog=SubElement(data,'ELOG_LINK')
    elog.text=elogText
    comment=SubElement(data,'COMMENTS')
    comment.text=commentText


def prettify(element):
    rough_string = ElementTree.tostring(element, encoding="UTF-8")#, method="xml")
    reparsed = minidom.parseString(rough_string)
    return reparsed.toprettyxml(indent="  ")
