#include "libft.h"

void	ft_print_result(char const *s)
{
	int		len;

	len = 0;
	while (s[len])
		len++;
	write(1, s, len);
}

int main(void)
{
    char **tab;
    int i;

    tab = ft_strsplit("*salut****!**", '*');
    i = 0;
    while (tab[i] != '\0')
			{
				ft_print_result(tab[i]);
				write(1, "\n", 1);
				i++;
			}
    return (0);
}
