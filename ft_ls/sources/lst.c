/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   lst.c                                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:23:37 by malallai          #+#    #+#             */
/*   Updated: 2019/03/17 17:12:43 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

t_file		*new_file(void)
{
	t_file *file;

	file = (t_file *)malloc(sizeof(t_file *));
	file->next = NULL;
	return (file);
}

void		add_file(t_opt	*opt, struct dirent *dirent)
{
	t_file *new;

	new = new_file();
	new->dirent = dirent;
	if (!opt->init)
	{
		opt->first = new;
		opt->last = opt->first;
	}
	else
	{
		opt->last->next = new;
		opt->last = new;
	}
}

t_opt		*new_opt(void)
{
	t_opt	*opt;
	int		index;

	index = 0;
	opt = malloc(sizeof(t_opt *));
	opt->entries = malloc(sizeof(t_entry *));
	opt->files = malloc(sizeof(t_entry *));
	opt->folders = malloc(sizeof(t_entry *));
	opt->init = 0;
	return (opt);
}

void		set_opt_folders(t_opt *opt, int argc, char **argv, int index)
{
	int argv_index;
	int folder_index;

	argv_index = index;
	folder_index = 0;
	opt->entries->count = argc - argv_index;
	opt->entries->array = malloc(sizeof(char *) * opt->entries->count);
	while (argv_index < argc)
		opt->entries->array[folder_index++] = ft_strdup(argv[argv_index++]);
	opt->entries->array[folder_index] = NULL;
	opt->files->array = malloc(sizeof(char *) * opt->entries->count);
	opt->folders->array = malloc(sizeof(char *) * opt->entries->count);
}
