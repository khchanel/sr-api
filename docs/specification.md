# SR Web Service API Specification
----

All endpoints are prefixed with API version string (e.g.  /api/v1)
All endpoints return in json format

# Endpoint summary

* GET /api/v1/project
* GET /api/v1/location
* GET /api/v1/sor


# Endpoint - Projects

## GET /api/v1/project

Return array of project data
Return 401 on authentication error


### Parameters:

    user:       username
    passwd:     password

### Examples:

* GET /api/v1/project

Response 401
```
{"error":"401 Unauthorized"}
```

* GET /api/v1/project?user=xxx&passwd=yyy

Response 200
```
[{
  "Address": "22\/15-25 Burns Road, LEUMEAH, NSW, 2560",
  "Client": "St George Community Housing",
  "ClientRef": "0044005",
  "Code": 72282,
  "ContractorRef": null,
  "Coordinator": "Adris Frety",
  "Duration": null,
  "Finish": "05\/09\/2014",
  "FinishDate": null,
  "Instructions": "EOT: Work Insurance scope",
  "MasterCode": null,
  "SLA": null,
  "Start": "03\/09\/2014",
  "StartDate": null,
  "Status": "New",
  "SubClient": null,
  "TaskType": null
}, {
  "Address": "5 Fort Street , PETERSHAM, NSW, 2049",
  "Client": "St George Community Housing",
  "ClientRef": "0044007",
  "Code": 72271,
  "ContractorRef": null,
  "Coordinator": "Adris Frety",
  "Duration": null,
  "Finish": "17\/09\/2014",
  "FinishDate": null,
  "Instructions": "Smoke alarm",
  "MasterCode": null,
  "SLA": null,
  "Start": "03\/09\/2014",
  "StartDate": null,
  "Status": "New",
  "SubClient": null,
  "TaskType": null
}]
```

# Endpoint - Location

## GET /api/v1/location

Return array of Location

### Examples:

* GET /api/v1/location

Response 200
```
["AIRL","BED1","HALL"]
```


# Endpoint - SOR

## GET  /api/v1/sor

Return array of SOR data

### Parameters:

    keyword:    search keyword
    location:   filter by the location given
    page:       current page number
    per_page:   result per page

Note: if page or per_page are not given, result will come with no pagination
    parameters can be mixed and are optional

### Examples:

* GET /api/v1/sor?location=airl

Response 200
```
[{
  "SORCode": "MIN18350",
  "Tradecode": "",
  "UomCode": "m.",
  "Name": "(Renew strip flooring up to 6 metres)",
  "LongDescription": "Remove and dispose of existing and supply and fix strip flooring up to 6 metres.  Hardwood\/Cypress up to 100mm wide.  Staggered joints - Each room.",
  "Status": "False",
  "Price201213": "9.999999999",
  "Price": "9.999999999",
  "Warranty": "0",
  "Manual": "0",
  "Deleted": "0",
  "Code": "606",
  "Location": "All,BED1 ,HALL, AIRL",
  "Photo": "~\\Files\\SOR\\1c8dbe4709ae44a388f6dee379a8f0bc.jpg"
}, {
  "SORCode": "MIN18400",
  "Tradecode": "",
  "UomCode": "m2.",
  "Name": "(Renew Cyprus flooring over 6.0lm ? additional to MIN18350)",
  "LongDescription": "Remove and dispose of existing and supply and fix new Cypress flooring over 6 lineal metres per separate room in addition to MIN18350.  Nails to be punched and filled - Staggered joints. Cypress Pine.",
  "Status": "False",
  "Price201213": "9.999999999",
  "Price": "9.999999999",
  "Warranty": "0",
  "Manual": "0",
  "Deleted": "0",
  "Code": "607",
  "Location": "AIRL",
  "Photo": ""
}]

```


* GET /api/v1/sor?keyword=silicon

Response 200
```
[{
  "SORCode": "MIN19750",
  "Tradecode": "",
  "UomCode": "Each.",
  "Name": "(Renew ceramic soap holder - recessed)",
  "LongDescription": "Remove and dispose of existing and supply and fix recessed ceramic soap holder 150 x 150mm, colour as directed.  Fixed with brass screws or epoxy resin adhesive. Silicone sealed.",
  "Status": "False",
  "Price201213": "9.999999999",
  "Price": "9.999999999",
  "Warranty": "0",
  "Manual": "0",
  "Deleted": "0",
  "Code": "632",
  "Location": "",
  "Photo": ""
}, {
  "SORCode": "MIN19850",
  "Tradecode": "",
  "UomCode": "Room.",
  "Name": "(Apply silicone sealant to horizontal & vertical joints)",
  "LongDescription": "Clean out horizontal and vertical joints between bath and tiles, shower recess corners, bath riser, kitchen benches and tiles, etc., and apply silicone sealant.  Colour as directed.",
  "Status": "False",
  "Price201213": "9.999999999",
  "Price": "9.999999999",
  "Warranty": "0",
  "Manual": "0",
  "Deleted": "0",
  "Code": "634",
  "Location": "",
  "Photo": ""
}]
```

* GET /api/v1/sor?keyword=silicon&page=5&per_page=1

Response 200
```
{
  "total": 40,
  "per_page": 1,
  "current_page": 5,
  "last_page": 40,
  "from": 5,
  "to": 5,
  "data": [{
    "SORCode": "PLU00700",
    "Tradecode": "",
    "UomCode": "Each.",
    "Name": "(Clean out blocked downpipe & stop leaks up to 2 storey)",
    "LongDescription": "Clean out blocked downpipe and stop leaks. Single storey re-cement downpipe into drain. Applies to amount of downpipe cleaned, not the overall length of the downpipe. Approved silicone or mastic to be used.",
    "Status": "False",
    "Price201213": "9.999999999",
    "Price": "9.999999999",
    "Warranty": "0",
    "Manual": "0",
    "Deleted": "0",
    "Code": "671",
    "Location": "",
    "Photo": ""
  }]
}
```
