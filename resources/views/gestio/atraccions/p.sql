SELECT
   users.id
FROM
   users
WHERE
   users.id NOT IN
   (
      SELECT
         assign_emp_atraccions.id_empleat
      FROM
         assign_emp_atraccions
      WHERE
         ( 'data_inici_global' BETWEEN assign_emp_atraccions.data_inici AND date_sub(assign_emp_atraccions.data_fi, INTERVAL +1 day))
         OR
         ( 'data_fi_global' BETWEEN date_sub(assign_emp_atraccions.data_inici, INTERVAL -1 day) AND assign_emp_atraccions.data_fi)
         OR
         ( assign_emp_atraccions.data_inici <= 'data_inici_global' AND assign_emp_atraccions.data_fi >= 'data_fi_global')
         OR
         ( assign_emp_atraccions.data_inici >= 'data_inici_global' AND assign_emp_atraccions.data_fi <= 'data_fi_global')
         )
