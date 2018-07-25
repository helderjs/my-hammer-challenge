Feature: Job
  In order to validate my application
  As a user
  I want to be able to manage jobs

  Scenario: Retrieves list jobs
    When I send a "GET" request to "/job"
    Then the response should be received
    And the response status code should be 200
    And the response body contains:
      """
      [
        {
          "uuid": "b9596b68-fb7f-44a6-aba6-356f6fc5d11b",
          "title": "My job title",
          "description": "My job description",
          "city": {
              "name": "Berlin",
              "zip_code": "10115"
          },
          "category": {
              "code": 804040,
              "name": "Sonstige Umzugsleistugen"
          },
          "execution_date": "2018-07-24"
        }
      ]
      """
  Scenario: Retrieve a job
    When I send a "GET" request to "/job/b9596b68-fb7f-44a6-aba6-356f6fc5d11b"
    Then the response should be received
    And the response status code should be 200
    And the response body contains:
      """
      {
        "uuid": "b9596b68-fb7f-44a6-aba6-356f6fc5d11b",
        "title": "My job title",
        "description": "My job description",
        "city": {
          "name": "Berlin",
          "zip_code": "10115"
        },
        "category": {
          "code": 804040,
          "name": "Sonstige Umzugsleistugen"
        },
        "execution_date": "2018-07-24"
      }
      """
  Scenario: Add a job
    When I send a "POST" request to "/job" with body:
      """
      {
        "title": "My job title 2",
        "description": "My job description 2",
        "city": "35dc6da7-4f61-401a-a06d-2de152141ecc",
        "category": "721fd003-e2ab-49bf-93f8-a089fa0c1fca",
        "executionDate": "2018-08-01"
      }
      """
    Then the response should be received
    And the response status code should be 201
    And the response body contains:
      """
      {
        "title": "My job title 2",
        "description": "My job description 2",
        "city": {
          "name": "Hamburg",
          "zip_code": "21521"
        },
        "category": {
          "code": 802030,
          "name": "Abtransport, Entsorgung und Entrümpelung"
        },
        "execution_date": "2018-08-01"
      }
      """
  Scenario: Update a job
    When I send a "PUT" request to "/job/b9596b68-fb7f-44a6-aba6-356f6fc5d11b" with body:
      """
      {
        "title": "My job title 3",
        "description": "My job description 3",
        "city": "f1089efd-01a7-4410-a990-2c3002662f01",
        "category": "df3701f5-4b8d-4910-9a9f-77c06acda016",
        "executionDate": "2018-07-24"
      }
      """
    Then the response should be received
    And the response status code should be 200
    And the response body contains:
      """
      {
        "uuid": "b9596b68-fb7f-44a6-aba6-356f6fc5d11b",
        "title": "My job title 3",
        "description": "My job description 3",
        "city": {
          "name": "Berlin",
          "zip_code": "10115"
        },
        "category": {
          "code": 804040,
          "name": "Sonstige Umzugsleistugen"
        },
        "execution_date": "2018-07-24"
      }
      """
  Scenario: Delete a job
    When I send a "DELETE" request to "/job/b9596b68-fb7f-44a6-aba6-356f6fc5d11b"
    Then the response status code should be 204
