#include "../includes/fillit.h"

int is_char(char c)
{
	return (c && (c == '.' || c == '#' || c == '\n'));
}

void error()
{
	ft_putendl("error");
}

void fillit(int argc, char **argv)
{
	char	*buffer;
	int		ret;
	int		fd;
	char	*tmp;

	if (argc != 2)
	{
		ft_putendl("Usage: ./fillit [file]");
		return;
	}
	else
	{
		fd = open(argv[1], O_RDONLY);
		if (fd < 0)
			return error();
		buffer = ft_strnew(22);
		while ((ret = read(fd, buffer, 21)) > 0)
		{
			buffer[21] = '\0';
			tmp = ft_strreplace(buffer, '.', 0);
			tmp = ft_trimchar(tmp, '\n');
			ft_putendl("-----");
			ft_putendl(tmp);
			free(buffer);
			buffer = ft_strnew(22);
		}
		if (ret == -1)
			return error();
	}
}
