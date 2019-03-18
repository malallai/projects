/* *************************************************************************/
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   utils.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 17:33:25 by malallai          #+#    #+#             */
/*   Updated: 2019/03/18 14:35:17 by malallai         ###   ########.fr       */
/*                                                                            */
/* *************************************************************************/

#include <ft_ls.h>

char	get_dtype(unsigned char type)
{
	if (type == DT_BLK)
		return ('p');
	else if (type == DT_CHR)
		return ('c');
	else if (type == DT_DIR)
		return ('d');
	else if (type == DT_FIFO)
		return ('t');
	else if (type == DT_LNK)
		return ('l');
	else if (type == DT_REG)
		return ('-');
	else if (type == DT_SOCK)
		return ('s');
	return ('-');
}

char	*get_color(char type, int mode)
{
	char *color;

	if (type == F_DIR)
		color = ft_strdup("\033[1;36m");
	else if (type == F_LINK)
		color = ft_strdup("\033[0;35m");
	else if (mode & S_IXUSR)
		color = ft_strdup("\033[0;31m");
	else
		color = ft_strdup("\033[0m");
	return (color);
}

char	*get_mode(int mode, unsigned char type)
{
	char *perm;

	perm = (char *)malloc(sizeof(char *) * 11);
	perm[0] = get_dtype(type);
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
