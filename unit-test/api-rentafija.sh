for m in 01 02 03 04 05 06 07 08 09 10 11 12
do
 for i in 01 02 03 04 05 06 07 08 09 10 11 12 13 14 15 16 17 18 19 20
 do
    echo "Welcome $i times"
    wget http://extractos.local/api/fija-report/8605144712/2016-$m-$i
 done
done

echo 'Terminado..'