#include <stdio.h>
#include <string.h>
#include "libft.h"

int main(void)
{
	printf("'%s'\n", ft_strtrim("         \n\t \r    LoremIpsum     \f\t\v   \n "));
	return (0);
}