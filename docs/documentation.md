# Authorization

Application use API token to authorize requests. No other authorization protocols are supported.

# Authorizing requests with API token

All requests to the API must be authorized by an authenticated user(scientist).

## Generate token request

```
curl -X POST tokens/generate
   -H 'Content-Type: application/json'
   -d '{  "name": "Pawel","password": "Pawel123","roles": ["SPACE_SCIENTIST"]}'
```

## Example response

```
{
    "data": {
        "type": "token",
        "id": "1",
        "attributes": {
            "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiMTIzNDU2Nzg5MCIsInBhc3N3b3JkIjoiSm9obiBEb2UiLCJyb2xlcyI6WyJTUEFDRV9TQ0lFTlRJU1QiXX0.DvK47f7G4UDNPBSpcmaNxKEE1DrZAP4isdbDhsHec_U"
        },
          "links": {
            "self": "/tokens/generate"
               }
            }
        }
    }
}
```
