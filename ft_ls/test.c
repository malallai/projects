#include <ft_ls.h>

int main(int argc, char **argv)
{
	struct stat path_stat;

    stat(argv[1], &path_stat);
	ft_putnbrln(S_ISDIR(path_stat.st_mode));
	ft_putnbrln(S_ISLNK(path_stat.st_mode));
	ft_putnbrln(path_stat.st_mode);
	stat(argv[2], &path_stat);
	ft_putnbrln(S_ISDIR(path_stat.st_mode));
	ft_putnbrln(S_ISLNK(path_stat.st_mode));
	ft_putnbrln(path_stat.st_mode);
	return (0);
}
