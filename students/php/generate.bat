
for /F %%x in ('dir /b /s *.pug ') do (
  relaxed --bo %%x
 
)