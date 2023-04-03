-- This SQL SELECT statement retrieves all duplicate email addresses for the same UserRefID where the user is alive and at least one of the emails is a default email address.

SELECT DISTINCT e.emailaddress
FROM emails e
INNER JOIN profiles p ON e.UserRefID = p.UserRefID
WHERE p.Deceased = 0
AND e.Default = 1
AND e.emailaddress IN (
  SELECT emailaddress
  FROM emails
  WHERE UserRefID IN (
    SELECT UserRefID
    FROM emails
    WHERE emailaddress <> '' AND emailaddress IS NOT NULL
    GROUP BY UserRefID, emailaddress
    HAVING COUNT(*)
 > 1
  )
)