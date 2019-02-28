/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/02 14:36:09 by bclerc            #+#    #+#             */
/*   Updated: 2019/02/28 10:36:45 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "ft_ls.h"


t_file *ls(struct dirent *sd, char *name)
{
	t_file *ls;
	char	*tmp;
	struct stat buff;
	struct passwd *pInfo;
	struct group *gInfo;

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

int main(int argc, char **argv)
{
	t_opt opt;
	int i;

	opt.max = argc;
	i = parse(argv, &opt);
	opt.skip = i == argc ? 1 : 0;
	read_file(argv, i, &opt);
	printls(opt.folder, &opt);
	destroyls(opt.folder);
}

