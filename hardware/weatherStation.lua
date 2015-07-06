--bh1750 = require("bh1750")
--bh1750.init(SDA_PIN, SCL_PIN)

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
  conn:send(thePayload)
  print('Posting data to weather station central...')
  ws2812.writergb(1, string.char(55,55,0) )
end

-- ****************************
readTemp = function(thePin)
  status,temp,humi,temp_decimial,humi_decimial = dht.read(thePin)
  if( status == dht.OK ) then
    print("DHT Temperature:"..temp..";".."Humidity:"..humi)
  elseif( status == dht.ERROR_CHECKSUM ) then
    print( "DHT Checksum error." );
  elseif( status == dht.ERROR_TIMEOUT ) then
    print( "DHT Time out." );    
  end
end

--- ****************************
measureeAndSendData = function() 
  xdata = {}

  status,temp,humi,temp_decimial,humi_decimial = dht.read(outsidePin)
  if( status == dht.OK ) then
    xdata['temperatureOutside'] = temp
    xdata['humidityOutside'] = humi
  else 
    print("Error reading outside temp")  
  end

  status,temp,humi,temp_decimial,humi_decimial = dht.read(insidePin)
  if( status == dht.OK ) then
    xdata['temperatureInside'] = temp
    xdata['humidityInside'] = humi
  end
  
  bh1750.read(OSS)
  xdata['luminosity'] = bh1750.getlux();
  
  postData(xdata)
end


