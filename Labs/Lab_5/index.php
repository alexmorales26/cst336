<!DOCTYPE html>
<html>
    <head>
        <title>Lab 5: Device Search </title>
    </head>
    <body>
    <h1> Technology Center: Checkout System </h1>
    
    <form>
      Device:  <input type="text" name="deviceName" placeholder="Device Name"/>
      Type:
      <select name="deviceType">
          <?=getDeviceTypes()?>
      </select>
        <input type="submit" value="Submit"/>
    </form>
    </body>
</html>