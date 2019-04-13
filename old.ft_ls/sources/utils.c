/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   utils.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/21 15:44:43 by malallai          #+#    #+#             */
/*   Updated: 2019/03/23 16:55:35 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

char	get_dtype(int mode)
{
	if (S_ISBLK(mode))
		return ('p');
	else if (S_ISCHR(mode))
		return ('c');
	else if (S_ISDIR(mode))
		return ('d');
	else if (S_ISFIFO(mode))
		return ('t');
	else if (S_ISLNK(mode))
		return ('l');
	else if (S_ISREG(mode))
		return ('-');
	else if (S_ISSOCK(mode))
		return ('s');
	return ('-');
}

char	*get_color(int mode)
{
	if (S_ISLNK(mode))
		return (PURPLE);
	else if (S_ISDIR(mode))
		return (CYAN);
	else if (mode & S_IXUSR)
		return (RED);
	return (WHITE);
}

char	*get_mode(int mode)
{
	char *perm;

	perm = (char *)malloc(sizeof(char *) * 11);
	perm[0] = get_dtype(mode);
	perm[1] = (mode & S_IWUSR) && (mode & S_IWRITE) ? 'r' : '-';
	perm[2] = (mode & S_IWUSR) && (mode & S_IWRITE) ? 'w' : '-';
	perm[3] = (mode & S_IXUSR) && (mode & S_IEXEC) ? 'x' : '-';
	perm[4] = (mode & S_IRGRP) && (mode & S_IREAD) ? 'r' : '-';
	perm[5] = (mode & S_IWGRP) && (mode & S_IWRITE) ? 'w' : '-';
	perm[6] = (mode & S_IXGRP) && (mode & S_IEXEC) ? 'x' : '-';
	perm[7] = (mode & S_IROTH) && (mode & S_IREAD) ? 'r' : '-';
	perm[8] = (mode & S_IWOTH) && (mode & S_IWRITE) ? 'w' : '-';
	perm[9] = (mode & S_IXOTH) && (mode & S_IEXEC) ? 'x' : '-';
	perm[10] = 0;
	return (perm);
}

int		has_flag(t_opt *opt, int flag)
{
	return ((opt->flag & flag) > 0);
}
