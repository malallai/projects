#include "main.h"

int		main(int argc, char **argv)
{
	(void)argc;
	(void)argv;
	int *tab = malloc(sizeof(int *) * 15);
	ft_bzero(tab, 15);
	int i = 0;
	int tmp = 0;
	while (i < 15) {
		tab[i] = i;
		i++;
	}
	i = 0;
	while (i < 15)
		ft_putnbrln(tab[i++]);
	ft_putendl("----");
	i = 0;
	tmp = tab[0];
	while (i < 15)
	{
		tab[i] = tab[i + 1];
		i++;
	}
	tab[14] = tmp;
	i = 0;
	while (i < 15)
		ft_putnbrln(tab[i++]);
	return (0);
}