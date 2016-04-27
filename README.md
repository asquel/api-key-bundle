# API KEY Bundle

## Config : 

```
asquel_api_key:
  is_header: true
  parameter_name: X-API-KEY
  api_key_value: test_key
  authenticator_service: 'asquel.api_key_bundle.authenticator'
  urls_whitelist:
      - { path: ^/api/doc }
      
```