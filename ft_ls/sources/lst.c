/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   lst.c                                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:23:37 by malallai          #+#    #+#             */
/*   Updated: 2019/03/16 19:21:50 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

t_entry		*new_entry(void)
{
	t_entry *entry;

	entry = (t_entry *)malloc(sizeof(t_entry *));
	entry->next = NULL;
	return (entry);
}

void		add_entry(t_opt	*opt, struct dirent *dirent)
{
	t_entry *new;

	new = new_entry();
	new->dirent = dirent;
	if (opt->entries == NULL)
	{
		opt->entries = new;
		opt->first_entry = opt->entries;
	}
	else
	{
		opt->entries->next = new;
		opt->entries = new;
	}
}

t_opt		*new_opt(void)
{
	t_opt	*opt;
	int		index;

	index = 0;
	opt = malloc(sizeof(t_opt));
	opt->entries = NULL;
	opt->first_entry = NULL;
	opt->current = 0;
	opt->folders_count = 1;
	opt->argv = NULL;
	opt->files = NULL;
	opt->folders = NULL;
	return (opt);
}

void		set_opt_folders(t_opt *opt, int argc, char **argv, int index)
{
	int argv_index;
	int folder_index;

	argv_index = index;
	folder_index = 0;
	opt->folders_count = argc - argv_index;
	opt->argv = malloc(sizeof(char *) * opt->folders_count);
	while (argv_index < argc)
		opt->argv[folder_index++] = ft_strdup(argv[argv_index++]);
	opt->argv[folder_index] = NULL;
	opt->files = malloc(sizeof(char *) * opt->files_count);
	opt->folders = malloc(sizeof(char *) * opt->files_count);
}
