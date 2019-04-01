/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 12:21:44 by malallai          #+#    #+#             */
/*   Updated: 2019/04/01 15:15:43 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

static void	print_file(t_file *file)
{
	if (!file)
		return ;
	ft_putstr(file->name);
	ft_putstr(" -> ");
	ft_putendl(file->path);
	print_file(file->next);
}

int		main(int argc, char **argv)
{
	t_opt		*opt;
	int			i;

	opt = init_opt();
	if (argc == 1)
	{
		opt->main = new_file(0, ".", "");
		opt->main_count = 1;
	}
	else
	{
		i = parse(argv, opt);
		set_main_files(opt, argc, argv, i);
		sort(opt, opt->main, 0, opt->main_count - 1);
	}
	return (exit_ftls(opt));
}

/*int		main(int argc, char **argv)
{
	char	*parent;
	char	*name;
	char	*tmp;
	char	*path;

	if (argc == 1)
		return (0);
	parent = argv[1];
	name = argv[2];
	if (to_folder(name, parent))
		tmp = ft_strjoin(name, "/");
	else
		tmp = ft_strdup(name);
	if (parent)
		path = ft_strjoin(parent, tmp);
	else
		path = ft_strjoin(name[0] == '/' ? "" : "./", tmp);
	DEBUG("%s %s : %s\n", parent, name, path);
	return (0);
}*/
