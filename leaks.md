Main > "sleep(15); while(1);"
export MallocStackLogging=YES
./a.out &
leaks pid
kill pid