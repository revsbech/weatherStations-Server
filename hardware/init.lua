wifi.setmode(wifi.STATION)
wifi.sta.config("Møllehøj","elisabeth")
print(wifi.sta.getip())

outsidePin = 3
insidePin = 2
ledPin = 1

require("weatherStation")
ws2812.writergb(ledPin, string.char(0,0,0) )


--tmr.alarm(0, 60000, 1, measureeAndSendData )

--tmr.alarm(1, 1000, 1, function() print("hello world") end )
--tmr.stop(0)
