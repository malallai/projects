/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   brycefdp.h                                         :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/11 14:00:39 by malallai          #+#    #+#             */
/*   Updated: 2019/03/11 14:06:41 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef BRYCEFDP_H
# define BRYECEFDP_H

# include <stdio.h>

typedef struct		s_file
{
	char			*name;
	struct s_file	*next;
}					t_file;

typedef struct		s_opt
{
	int					flag;
	int					max;
	char				*path;
	t_file				*file;
	t_file				*folder;
}					t_opt;

#endif