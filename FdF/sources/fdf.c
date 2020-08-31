#include "../includes/fdf.h"

int		main(int argc, char **argv)
{
	void	*mlx_ptr;
	void	*win_ptr;

	ft_putendl(argv[0]);
	if (argc == 1)
	{
		mlx_ptr = mlx_init();
		win_ptr = mlx_new_window(mlx_ptr, 1280, 720, "Test");
		mlx_loop(mlx_ptr);
	}
	return (0);
}
