Feature: Posts

Scenario: Returning a collection of posts
    When I request "GET /posts"
    Then I get a "200" response
    And scope into the first "data" property
        And the properties exist:
            """
            id
            content
            """
        And the "id" property is an integer

Scenario: Finding a specific post
    When I request "GET /posts/1"
    Then I get a "200" response
    And scope into the "data" property
        And the properties exist:
            """
            id
            content
            """
        And the "id" property is an integer

Scenario: Searching non-existent post
    When I request "GET /posts?q=c800e42c377881f8202e7dae509cf9a516d4eb59&lat=1&lon=1"
    Then I get a "200" response
    And the "data" property contains 0 items


Scenario: Searching posts with filters
    When I request "GET /posts?id=3"
    Then I get a "200" response
    And the "data" property is an array
    And scope into the first "data" property
        And the properties exist:
            """
            id
            content
            """
    And reset scope