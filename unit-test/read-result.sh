FILES='*'
SUBSTRING=$(echo $INPUT| cut -d'_' -f 2)
echo $SUBSTRING
for file in $FILES
do
echo $file
RESULT=cat $file|grep '{"personal_data":'
echo $RESULT
echo '-------------------'
done
