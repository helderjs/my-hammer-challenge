Feature: Category
  In order to validate my application
  As a user
  I want to be able to manage categories

  Scenario: Retrieves list of categories
    When I send a "GET" request to "/category"
    Then the response should be received
    And the response status code should be 200
    And the response body contains:
      """
      [
        {
          "uuid": "721fd003-e2ab-49bf-93f8-a089fa0c1fca",
          "code": 802030,
          "name": "Abtransport, Entsorgung und Entrümpelung"
        },
        {
          "uuid": "79f09ae0-ed36-498f-abcf-9aa9f5351ebb",
          "code": 108140,
          "name": "Kellersanierung"
        },
        {
          "uuid": "8813457d-3779-45b9-b46b-5ccd6cf4cb1b",
          "code": 411070,
          "name": "Fensterreinigung"
        },
        {
          "uuid": "dd9be6ae-ca72-446d-bf95-c3fec98fd30e",
          "code": 402020,
          "name": "Holzdielen schleifen"
        },
        {
          "uuid": "df3701f5-4b8d-4910-9a9f-77c06acda016",
          "code": 804040,
          "name": "Sonstige Umzugsleistugen"
        }
    ]
      """
  Scenario: Retrieve a category
    When I send a "GET" request to "/category/8813457d-3779-45b9-b46b-5ccd6cf4cb1b"
    Then the response should be received
    And the response status code should be 200
    And the response body contains:
      """
      {
        "uuid": "8813457d-3779-45b9-b46b-5ccd6cf4cb1b",
        "name":"Fensterreinigung",
        "code":411070
      }
      """
