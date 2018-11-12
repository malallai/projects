for entry in ./*.c
do
  echo "\t$entry \\" | sed -e "s/\.\///" >> c.txt
done
find ./*.c | wc -l | bc
