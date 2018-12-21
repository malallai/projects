#include "../includes/fillit.h"

void	fillit(int argc, char ** argv)
{
	char *line;
	int fd;
	int r = 0 ;

	if (argc == 2)
	{
		if (!(fd = open(argv[1], O_RDONLY)))
		{
			ft_putendl("Error");
			return ;
		}
		while ((r = ft_get_next_line(fd, &line)) > 0)
		{
			ft_putendl(line);
			free(line);
		}
		close(fd);
	}
}
