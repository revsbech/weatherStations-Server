dht22 = require("dht22")

-- ****************************
postData = function(lldata) 
  jsondata = "data=" .. cjson.encode(lldata)
  print(jsondata)
  conn=net.createConnection(net.TCP, 0)
  conn:on("receive", 
    function(conn, payload) 
      ws2812.writergb(1, string.char(0,0,0) )
      print(payload) 
      --conn:close()
    end 
  )
  conn:connect(80,"91.223.235.181")
  thePayload = "POST /api/submit HTTP/1.1\r\nHost: weather.bancos.pil.dk\r\nConnection: keep-alive\r\nContent-Type: application/x-www-form-urlencoded\r\nAccept: */*\r\nContent-Length: " .. string.len(jsondata).. "\r\n\r\n" .. jsondata
  --print(thePayload)
  conn:send(thePayload)
  print('Posting data to weather station central...')
  ws2812.writergb(1, string.char(55,55,0) )
end


-- ****************************
readTemp = function(thePin) 
  dht22.read(thePin)
  t = dht22.getTemperature()
  h = dht22.getHumidity()
  humi=(h/10).."."..(h%10)
  temp=(t/10).."."..(t%10) 
  print("Humidity:    "..humi.."%")
  print("Temperature: "..temp.." deg C")
end

-- ****************************
measureeAndSendData = function() 
  dht22.read(outsidePin)
  t = dht22.getTemperature()
  h = dht22.getHumidity()
  humi=(h/10).."."..(h%10)
  temp=(t/10).."."..(t%10)  
  xdata = {}
  xdata['temperatureOutside'] = temp;
  xdata['humidityOutside'] = humi;

  dht22.read(insidePin)
  tInside = dht22.getTemperature()
  hInside = dht22.getHumidity()
  humiInside=(hInside/10).."."..(hInside%10)
  tempInside=(tInside/10).."."..(tInside%10)  
  xdata['temperatureInside'] = tempInside;
  xdata['humidityInside'] = humiInside;
  postData(xdata)
end


