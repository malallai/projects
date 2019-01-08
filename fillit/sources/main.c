#include "../includes/fillit.h"

int		main(int argc, char **argv)
{
	int fd;

	if (argc != 2)
	{
		ft_putendl("Usage: ./fillit [file]");
		return (0);
	}
	else
	{
		fd = open(argv[1], O_RDONLY);
		if (fd < 0)
			return (print_int_error());
		argv[2] = ft_itoa(fd);
		fillit(argv);
	}
	return (0);
}
