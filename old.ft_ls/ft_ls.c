/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/02 14:36:09 by bclerc            #+#    #+#             */
/*   Updated: 2019/03/16 13:44:03 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "ft_ls.h"

void	add_list(t_file **alst, t_file *new)
{
	if (!alst || !new)
		return ;
	new->next = *alst;
	*alst = new;
}

int		create(t_opt *opt, struct dirent *dirent)
{
	t_file *new;

	new = (t_file*)malloc(sizeof(t_file));
	new->name = dirent->d_name;
	if (!opt->file)
		opt->file = new;
	else
		add_list(&opt->file, new);
	return (0);
}

int		ls_read(t_opt *opt)
{
	DIR				*dir;
	struct dirent	*sd;

	if (!(dir = opendir(opt->path)))
	{
		ft_putstr("ft_ls: ");
		ft_putstr(opt->path);
		ft_putstr(": No such file or directory\n");
		return (1);
	}
	while ((sd = readdir(dir)))
	{
		create(opt, sd);
	}
	closedir(dir);
	return (0);
}

int		ls_clearlst(t_file *file)
{
	if (!file)
		return (0);
	ls_clearlst(file->next);
	free(file);
	return (0);
}

int		ls_destroy(t_opt *opt)
{
	ls_clearlst(opt->folder);
	ls_clearlst(opt->file);
	return (0);
}

int		main(int argc, char **argv)
{
	t_opt	opt;
	int		i;

	opt.max = argc;
	i = parse(argv, &opt);
	opt.path = argc == i ? "." : argv[i];
	ls_read(&opt);
	ls_print(&opt);
	ls_destroy(&opt);
	return (0);
}
