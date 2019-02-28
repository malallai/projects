/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   display.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/25 11:55:16 by bclerc            #+#    #+#             */
/*   Updated: 2019/02/28 13:37:24 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

# include "ft_ls.h"


char *get_path(char *argv, char *name)
{
	char *tmp;

	if (argv[ft_strlen(argv) - 1] == '.')
	{
		return (ft_strdup(argv));
	}

	if (argv[ft_strlen(argv) - 1] == '/') 
	{
		tmp =  ft_strjoin(argv, name);
		return tmp;
	}
	tmp = ft_strjoin(argv, "/");
	return (ft_strcat(tmp, name));
}


t_file *ls(struct dirent *sd, char *name)
{
	t_file			*ls;
	char			*tmp;
	struct stat 	buff;
	struct passwd	*pInfo;
	struct group	*gInfo;

	if (!(ls = (t_file*)malloc(sizeof(t_file) * 1)))
		return NULL;
	tmp = get_path(name, sd->d_name);
	stat(tmp, &buff);
	pInfo 		=	getpwuid(buff.st_uid);
    gInfo 		= 	getgrgid(buff.st_gid);
	ls->name	= 	ft_strdup(sd->d_name);
	ls->stat 	= 	buff;
	ls->dirent 	= 	sd;
	ls->mode 	= 	print_mode(buff.st_mode, sd->d_type);
	ls->group 	= 	gInfo;
	ls->passwd 	=	pInfo;
	free(tmp);
	return ls;
}


int	read_file(char **argv, int index, t_opt *opt)
{
	DIR			*dir;
	t_folder	*folder;
	struct		dirent *sd;
	int			b;

	while (index < opt->max) 
	{
		if (!(dir = opendir(argv[index])))
		{
			ft_putstr("ft_ls: ");
			ft_putstr(argv[index]);
			ft_putstr(": No such file or directory\n");
			index++;
			continue;
		}
		while ((sd = readdir(dir)) && sd > 0)
		{ 		
			folder = (t_folder*)malloc(sizeof(t_folder) * 1);
			if (opt->folder == NULL)
			{
				opt->folder = folder;
				opt->folder->last = folder;
			}
			opt->folder->last->next = folder;
			opt->folder->last = folder;
			folder->t_file = ls(sd, argv[index]);
			folder->name = argv[index]; 
			folder->id = b;
		}
		closedir(dir);
		index++;
		b++;
	}
	opt->total = b;
	return (1);
}