1. Configure php extension euspe by documentation and remove osplm.ini from extension directory. 
2. Configure stubs for IDE to view functions docs.
3. Configure directories for servers, certificates, keys. 
   Look for osplm.dist.ini as example.
   Setup 0777 permissions on folders.
```
- certificates\
   - server.name\
   - ...
- keys\
   - server.name\
      - user-name\
         - key.[dat|jks]
         - password
   - ...
- servers\
   - server.name\
        - tmp\
        - osplm.ini
   - ...
```
4. Use interface for communication.