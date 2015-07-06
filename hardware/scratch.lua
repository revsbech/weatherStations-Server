
measureeAndSendData()
tmr.stop(0)
readTemp(outsidePin)
readTemp(insidePin)
measureLux()
ledPin = 1
ws2812.writergb(ledPin, string.char(255,255,255) )

status,temp,humi,temp_decimial,humi_decimial = dht.read(insidePin)
print("DHT Temperature:"..temp..";".."Humidity:"..humi)
dofile("weatherStation.lua");

l = file.list();
    for k,v in pairs(l) do
      print("name:"..k..", size:"..v)
    end

print(_G)



file.remove('readTemp.lua')
file.remove('scratch.lua')
file.remove('weatherStation.lua')
file.remove('dht22.lua')

file.list()

SDA_PIN = 4 -- sda pin, GPIO12
SCL_PIN = 5 -- scl pin, GPIO14



bh1750 = nil
package.loaded["bh1750"]=nil
bh1750 = require("bh1750")
bh1750.init(SDA_PIN, SCL_PIN)
bh1750.read(OSS)
l = bh1750.getlux()
print("lux: "..l)

PIN = 4
dht22 = require("dht22")
dht22.read(PIN)
t = dht22.getTemperature()
h = dht22.getHumidity()
humi=(h/10).."."..(h%10)
temp=(t/10).."."..(t%10)
fare=(9*t/50+32).."."..(9*t/5%10)
print("Humidity:    "..humi.."%")
print("Temperature: "..temp.." deg C")

print("Temperature: "..fare.." deg F")

    timer.Create('readTemp', 1, 5,  function() print( 'inside' ) end)


    tmr.alarm(0, 1000, 1, function() print("hello world") end )


outsidePin = 4

tmr.alarm(0, 3000, 1, readTemp(4) )

tmr.stop(0)

PIN = 4
dht22 = require("dht22")

readTemp = function(thePin) 
dht22.read(thePin)
t = dht22.getTemperature()
h = dht22.getHumidity()
humi=(h/10).."."..(h%10)
temp=(t/10).."."..(t%10)
fare=(9*t/50+32).."."..(9*t/5%10)
print("Humidity:    "..humi.."%")
print("Temperature: "..temp.." deg C")
end

print(readTemp)
