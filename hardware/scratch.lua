ws2812.writergb(1, string.char(255,255,0) )

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