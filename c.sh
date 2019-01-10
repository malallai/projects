rm c.txt
for entry in $1/*.c
do
  echo "\t$entry \\" | sed -e "s/\.\///" | sed -e "s/.*\///" >> c.txt
done
count=`find $1/*.c | wc -l | bc`
printf "Found %d files in %s\n" $count $1
cat c.txt