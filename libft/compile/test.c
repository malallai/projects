#include <stdio.h>
#include <string.h>
#include "libft.h"

char	*ft_strsub(char const *s, unsigned int start, size_t len)
{
	char *sub;

	if (!s || start + len > ft_strlen(s) || !(sub = ft_strnew(len)))
		return (NULL);
	return (ft_strncpy(sub, s + start, len));
}

int main(void)
{
	printf("%s\n", ft_strsub("LoremIpsum", 2, 5));
	return (0);
}