SELECT
   users.id
FROM
   users
WHERE
   users.id NOT IN
   (
      SELECT
         assign_emp_atraccions.id
      FROM
         assign_emp_atraccions
      WHERE
         ( 'data_entrada' BETWEEN assign_emp_atraccions.data_inici AND date_sub(assign_emp_atraccions.data_fi, INTERVAL +1 day))
         OR
         ( 'data_surtida' BETWEEN date_sub(assign_emp_atraccions.data_inici, INTERVAL -1 day) AND assign_emp_atraccions.data_fi)
         OR
         ( assign_emp_atraccions.data_inici <= 'data_entrada' AND assign_emp_atraccions.data_fi >= 'data_fi')
         OR
         ( assign_emp_atraccions.data_inici >= 'data_entrada' AND assign_emp_atraccions.data_fi <= 'datafi')
         )
