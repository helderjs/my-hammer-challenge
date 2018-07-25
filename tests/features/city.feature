Feature: City
  In order to validate my application
  As a user
  I want to be able to manage cities/zip code

  Scenario: Retrieves list of cities/zip code
    When I send a "GET" request to "/city"
    Then the response should be received
    And the response status code should be 200
    And the response body contains:
      """
      [
        {
          "uuid": "35dc6da7-4f61-401a-a06d-2de152141ecc",
          "name": "Hamburg",
          "zip_code": "21521"
        },
        {
          "uuid": "51be39e7-255a-4dfd-94da-0f58f03c343a",
          "name": "Porta Westfalica",
          "zip_code": "32457"
        },
        {
          "uuid": "7e620927-3460-40a8-b092-20fded977a4e",
          "name": "Lommatzsch",
          "zip_code": "01623"
        },
        {
          "uuid": "835eb748-710e-4bbf-9aa9-c9c4ae966b7c",
          "name": "Diesbar-Seußlitz",
          "zip_code": "01612"
        },
        {
          "uuid": "ab0b3008-7c3f-47c0-9241-f1f2eb603406",
          "name": "Bülzig",
          "zip_code": "06895"
        },
        {
          "uuid": "f1089efd-01a7-4410-a990-2c3002662f01",
          "name": "Berlin",
          "zip_code": "10115"
        }
    ]
      """
  Scenario: Retrieve a city by zip code
    When I send a "GET" request to "/city/zipcode/10115"
    Then the response should be received
    And the response status code should be 200
    And the response body contains:
      """
      {
        "uuid": "f1089efd-01a7-4410-a990-2c3002662f01",
        "name":"Berlin",
        "zip_code":"10115"
      }
      """
